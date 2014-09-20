<?php

class ProductController extends Controller
{
	public $companyId = 0;
	public $mac = 0;
	public $seatNum = 0;
	public $layout = '/layouts/productmain';
	public function init(){
		session_start();
		$this->companyId = isset($_SESSION['companyId'])?$_SESSION['companyId']:0;
		$this->seatNum = isset($_SESSION['seatnum'])?$_SESSION['seatnum']:0;
		if(!$this->companyId){
			$mac = Yii::app()->request->getParam('wuyimenusysosyoyhmac',0);
			$companyWifi = CompanyWifi::model()->find('macid=:macId',array(':macId'=>$mac));
			$this->companyId = $companyWifi?$companyWifi->company_id:0;
			$_SESSION['companyId'] = $this->companyId;
		}
	}
	public function actionIndex()
	{
		$categoryId = Yii::app()->request->getParam('category',3);
		$categorys = ProductCategory::model()->findAll('company_id=:companyId and delete_flag=0',array(':companyId'=>2));
		$categoryId = $categoryId?$categoryId:($categorys?$categorys[0]['category_id']:0);
		$this->render('product',array('categorys'=>$categorys,'categoryId'=>$categoryId));
	}
	public function actionGetJson()
	{
		$page = Yii::app()->request->getParam('page',0);
		$categoryId = Yii::app()->request->getParam('cat',0);
		$sql = 'select * from nb_product where company_id=2 and category_id=:categoryId and delete_flag=0 limit :page,8';
		$connect = Yii::app()->db->createCommand($sql);
		$connect->bindValue(':categoryId',$categoryId);
		$connect->bindValue(':page',$page);
		$product = $connect->queryAll();
		Yii::app()->end(json_encode($product));
	}
	 /**
	  * 
	  * 推荐商品
	  */
	 public function actionRecommend(){
	 	$criteria = new CDbCriteria;
	 	$criteria->addCondition('company_id=:companyId');
	 	$criteria->addCondition('recommend=1');
	 	$criteria->params[':companyId']=$this>companyId;  
	 	
	 	$models = Product::model()->findAll($criteria);
	 	$this->render('recommend',array('products'=>$models));
	 }
	/**
	 * 点单
	 * 
	 */
	public function actionCreateCart(){
		$seatNum = $this->seatNum?$this->seatNum:0;
		if($seatNum){
			$productId = Yii::app()->request->getParam('id');
			$now = time();
			$cart = new Cart;
			$cartDate = array(
			                'product_id'=>$productId,
			                'company_id'=>$this->companyId,
			                'code'=>$this->seatNum,
			                'product_num'=>1,
			                'create_time'=>$now,
			                );
	        $cart->attributes = $cartDate;
			if($cart->save()){
				echo 1;
			}else{
				echo 0;
			}
		}else{
			echo 2;//跳转座次号
		}
		Yii::app()->end();
	}
	/**
	 * 输入座次号
	 */
	public function actionInsertSeatNum(){
		if(Yii::app()->request->isPostRequest){
			$seatnum = Yii::app()->request->getPost('seatnum');
			$_SESSION['seatnum'] = $seatnum;
			$this->redirect(array('/product/index'));
		}
		$this->render('insertseatnum');
	}
	/**
	 * 
	 * 购物车列表
	 */
	public function actionCartList(){
		$cartLists = Cart::model()->with('product')->findAll('t.company_id=:companyId and t.code=:code',array(':companyId'=>$this->companyId,':code'=>$this->seatNum));
		$this->render('cartlist',array('cartLists'=>$cartLists,'seatnum'=>$this->seatNum));
	}
	/**
	 * 
	 * 点击减号减少购物车商品
	 */
	public function actionDeleteCartProduct(){
		$id = Yii::app()->request->getParam('id');
		$cartproduct= Cart::model()->find('company_id=:companyId and product_id=:productId',array(':companyId'=>$this->companyId,':productId'=>$id));
		if($cartproduct->delete()){
			echo 1;
		}else{
			echo 0;
		}
		Yii::app()->end();
	}
	public function actionDeleteCart(){
		$id = Yii::app()->request->getParam('id');
		$cart= Cart::model()->findByPk($id);
		$cart->delete();
		$this->redirect(array('/product/cartList'));
	}
	/**
	 * 生成订单
	 * $products = array(array(2,1,18),array(3,1,29)) ==>array(product_id,product_num,price)
	 */
	 
	 public function actionCreateOrder(){
	 	$seatnum = Yii::app()->request->getParam('code',0);
	 	if(!$seatnum){
	 		$this->redirect(array('/product/insertSeatNum'));
	 	}
	 	$siteNo = SiteNo::model()->find('company_id=:companyId and code=:code and delete_flag=0',array(':companyId'=>$this->companyId,':code'=>$seatnum));
	 	$site_no_id = $siteNo?$siteNo->id:0;
	 	$waiter_id = $siteNo?$siteNo->waiter_id:0;
	 	if(Yii::app()->request->isPostRequest){
	 		$now = time();
	 		$products = Yii::app()->request->getPost('products');
	 		
	 		$transaction=Yii::app()->db->beginTransaction();
	 		try{
		 		$order = new Order;
		 		$orderData = array(
		 							'company_id'=>$this->companyId,
		 							'site_no_id'=>$site_no_id,
		 							'waiter_id'=>$waiter_id,
		 							'create_time'=>$now,
		 							);
		 		$order->attributes = $orderData;
		 		$order->save();
		 		$orderId = $order->order_id;
		 		foreach($products as $product){
		 			$orderProduct = new OrderProduct;
		 				$productData = array(
		 									'order_id'=>$orderId,
		 									'product_id'=>$product[0],
		 									'product_num'=>$product[1],
		 									'price'=>$product[2],
		 									'amount'=>1,
		 									);
		 			$orderProduct->attributes = $productData;
		 			$orderProduct->save();
		 		}
		 		$transaction->commit();
	 		}catch (Exception $e) {
            	$transaction->rollback();//回滚函数
        	}
	 	}
	 	$this->redirect('/produc/orderList',array('id'=>$orderId));
	 }
	public function actionOrderList(){
		$orderId = Yii::app()->request->getParam('id',1);
		$orderProducts = OrderProduct::getOrderProducts($orderId);
		$totalPrice = OrderProduct::getTotal($orderId);
	 	$this->render('orderlist',array('orderProducts'=>$orderProducts,'totalPrice'=>$totalPrice,'seatNum'=>$this->seatNum));
	}
}
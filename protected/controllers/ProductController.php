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
		if(!$this->seatNum){
			$seatnum = rand(1000000,9999999);
			$_SESSION['seatnum'] = $seatnum;
		}
		if(!$this->companyId){
			$mac = Yii::app()->request->getParam('wuyimenusysosyoyhmac',0);
			$companyWifi = CompanyWifi::model()->find('macid=:macId',array(':macId'=>$mac));
			$this->companyId = $companyWifi?$companyWifi->company_id:0;
			$_SESSION['companyId'] = $this->companyId;
		}
	}
	/**
	 * 
	 * 获取一级分类
	 */
	public function actionProductCategory(){
		$command = Yii::app()->db;
		$sql = 'select category_id,category_name from nb_product_category where company_id=:companyId and pid=0 and delete_flag=0';
		$parentCategorys = $command->createCommand($sql)->bindValue(':companyId',$this->companyId)->queryAll();
		$this->render('parentcategory',array('parentCategorys'=>$parentCategorys));
	}
	/**
	 * 
	 * 获取分类商品
	 */
	public function actionIndex()
	{
		$pid = Yii::app()->request->getParam('pid',0);
		$categoryId = Yii::app()->request->getParam('category',0);
		$categorys = ProductCategory::model()->findAll('company_id=:companyId and pid=:pid and delete_flag=0',array(':companyId'=>$this->companyId,':pid'=>$pid));
		$categoryId = $categoryId?$categoryId:($categorys?$categorys[0]['category_id']:0);
		$this->render('product',array('categorys'=>$categorys,'categoryId'=>$categoryId,'pid'=>$pid));
	}
	/**
	 * 
	 * 商品详情
	 */
	 public function actionProductInfo(){
	 	$id = Yii::app()->request->getParam('id',0);
	 	$product = Product::model()->findByPk($id);
	 	$this->render('productinfo',array('product'=>$product));
	 }
	 /**
	  * 
	  * 推荐商品
	  */
	 public function actionRecommend(){
	 	$this->render('recommend');
	 }
	public function actionGetJson()
	{
		$page = Yii::app()->request->getParam('page',1);
		$rec = Yii::app()->request->getParam('rec',0);
		if($rec){
			$sql = 'select * from nb_product where company_id=:companyId and recommend=1 and status=0 and delete_flag=0 limit '. ($page-1)*8 .',8';
			$connect = Yii::app()->db->createCommand($sql);
		}else{
			$categoryId = Yii::app()->request->getParam('cat',0);
			$sql = 'select * from nb_product where company_id=:companyId and category_id=:categoryId and status=0 and delete_flag=0 limit '. ($page-1)*8 .',8';
			$connect = Yii::app()->db->createCommand($sql);
			$connect->bindValue(':categoryId',$categoryId);
		}

		$connect->bindValue(':companyId',$this->companyId);
		$product = $connect->queryAll();
		Yii::app()->end(json_encode($product));
	}
	
	/**
	 * 点单
	 * 
	 */
	public function actionCreateCart(){
		$seatNum = $this->seatNum?$this->seatNum:0;
		//	$siteNo = SiteNo::model()->find('company_id=:companyId and code=:code and delete_flag=0',array(':companyId'=>$this->companyId,':code'=>$seatNum));
		$productId = Yii::app()->request->getParam('id');
		$now = time();
		$cart = new Cart;
		$cartDate = array(
		                'product_id'=>$productId,
		                'company_id'=>$this->companyId,
		                'code'=>$seatNum,
		                'product_num'=>1,
		                'create_time'=>$now,
		                );
        $cart->attributes = $cartDate;
		if($cart->save()){
			echo 1;
		}else{
			echo 0;
		}
		Yii::app()->end();
	}
	/**
	 * 输入座次号
	 */
	public function actionInsertSeatNum(){
		$referUrl = Yii::app()->request->urlReferrer;
		$error = '';
		if(Yii::app()->request->isPostRequest){
			$seatnum = Yii::app()->request->getPost('seatnum');
			$referUrl = Yii::app()->request->getPost('referUrl');
			$model = SiteNo::model()->find('company_id=:companyId and code=:code',array(':companyId'=>$this->companyId,':code'=>$seatnum));
			if($model){
				$_SESSION['seatnum'] = $seatnum;
				$this->redirect($referUrl);
			}else{
				$error = '输入座次号有误!';
			}
		}
		$this->render('insertseatnum',array('url'=>$referUrl,'error'=>$error));
	}
	/**
	 * 
	 * 购物车列表
	 */
	public function actionCartList(){
		$isCode = 0;//判断是否是服务生成的开台号 是1 否0
		$cartLists = array();
		$type = Yii::app()->request->getParam('type',0);//是否是服务员点单
		$seatnum = Yii::app()->request->getParam('code',0);
		if(!$seatnum){
			$seatnum = $this->seatNum;//如果没有开台号 设置为临时座次号
		}
		$model = SiteNo::model()->find('code=:code and delete_flag=0',array(':code'=>$seatnum));
		if($model){
			$isCode = 1;
			if($this->seatNum > 1000000){
				Cart::model()->updateAll(array('code'=>$seatnum),'code=:code',array(':code'=>$this->seatNum));
			}
			$cartLists = Cart::model()->with('product')->findAll('t.company_id=:companyId and t.code=:code',array(':companyId'=>$this->companyId,':code'=>$seatnum));
			
			$_SESSION['seatnum'] = $seatnum;//正式座次号放session
			$this->seatNum = $seatnum;
		}
		$this->render('cartlist',array('cartLists'=>$cartLists,'seatnum'=>$this->seatNum,'type'=>$type,'isCode'=>$isCode));
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
		$this->redirect(array('/product/cartList','code'=>$this->seatNum));
	}
	/**
	 * 生成订单
	 * $products = array(array(2,1,18),array(3,1,29)) ==>array(product_id,product_num,price)
	 */
	 
	 public function actionCreateOrder(){
	 	$seatnum = Yii::app()->request->getParam('code');
	 	
	 	$siteNo = SiteNo::model()->find('company_id=:companyId and code=:code and delete_flag=0',array(':companyId'=>$this->companyId,':code'=>$seatnum));
	 	if(!$siteNo){
	 		echo 0;exit;
	 	}
	 
	 	if(Yii::app()->request->isPostRequest){
	 		$now = time();
	 		$site_no_id = $siteNo->id;
	 		$waiter_id = $siteNo->waiter_id;
	 		$number = $siteNo->number;
	 		$products = Yii::app()->request->getPost('products');
	 		
	 		$transaction=Yii::app()->db->beginTransaction();
	 		try{
	 			$order = Order::model()->with('siteNo')->find('t.company_id=:companyId and siteNo.code=:code and delete_flag=0',array(':companyId'=>$this->companyId,':code'=>$seatnum));
		 		if(!$order){
		 			$order = new Order;
			 		$orderData = array(
			 							'company_id'=>$this->companyId,
			 							'site_no_id'=>$site_no_id,
			 							'waiter_id'=>$waiter_id,
			 							'create_time'=>$now,
			 							);
			 		$order->attributes = $orderData;
			 		$order->save();
		 		}
		 		$orderId = $order->order_id;
		 		foreach($products as $product){
		 			$orderProduct = new OrderProduct;
		 				$productData = array(
		 									'order_id'=>$orderId,
		 									'product_id'=>$product[0],
		 									'price'=>$product[2],
		 									'amount'=>$product[1],
		 									);
		 			$orderProduct->attributes = $productData;
		 			$orderProduct->save();
		 			$cart = Cart::model()->find('company_id=:companyId and product_id=:productId and code=:code',array(':companyId'=>$this->companyId,':productId'=>$product[0],':code'=>$this->seatNum));
		 			$cart->delete();
		 		}
		 		$transaction->commit();
		 		//setcookie('orderId',$orderId);
		 		$this->redirect(array('/product/orderList'));
	 		}catch (Exception $e) {
            	$transaction->rollback();//回滚函数
        	}
	 	}
	 	$this->redirect(array('/product/cartList'));
	 }
	public function actionOrderList(){
       	$isCode = 0;
       	$orderId = 0;
       	
		$model = Order::model()->with('siteNo')->find('t.order_status=0 and t.company_id=:companyId and code=:code and delete_flag=0',array(':code'=>$this->seatNum,':companyId'=>$this->companyId));
		
		$isCodeModel = SiteNo::model()->find('code=:code and delete_flag=0',array(':code'=>$this->seatNum));//判断是否是正式开台号
		if($model){
			$orderId = $model->order_id;
		}
		if($isCodeModel){
			$isCode = 1;
		}
		$time = $model?$model->create_time:0;
		$orderProducts = OrderProduct::getOrderProducts($orderId);
		
		$totalPrice = OrderProduct::getTotal($orderId);
		if($model){
			$priceInfo = Helper::calOrderConsume($model,$totalPrice);
		}else{
			$totalPrice['total'] = 0;
			$totalPrice['remark'] = '最低消费0元';
		}
		
	 	$this->render('orderlist',array('id'=>$orderId,'orderProducts'=>$orderProducts,'totalPrice'=>$priceInfo,'time'=>$time,'seatNum'=>$this->seatNum,'isCode'=>$isCode));
	}
}
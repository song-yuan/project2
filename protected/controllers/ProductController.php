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
		$categoryId = Yii::app()->request->getParam('category',0);
		$categorys = ProductCategory::model()->findAll('company_id=:companyId and delete_flag=0',array(':companyId'=>$this->companyId));
		$categoryId = $categoryId?$categoryId:($categorys?$categorys[0]['category_id']:0);
		$product = Product::model()->findAll('company_id=:companyId and category_id=:categoryId and delete_flag=0',array(':companyId'=>$this->companyId,':categoryId'=>$categoryId));
		$this->render('index',array('categorys'=>$categorys,'products'=>$product,'categoryId'=>$categoryId));
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
		$this->redirect('/product/cartList');
	}
	/**
	 * 生成订单
	 * 
	 */
	 
	 public function actionCreateOrder(){
	 	var_dump($_POST);exit;
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
}
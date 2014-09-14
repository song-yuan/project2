<?php
class OrderController extends BackendController
{
	public function beforeAction($action) {
		parent::beforeAction($action);
		if(!$this->companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司');
			$this->redirect(array('company/index'));
		}
		return true;
	}
	public function actionIndex(){
		$criteria = new CDbCriteria;
		$criteria->with = array('site' , 'site.isfree') ;
		$criteria->condition =  't.company_id='.$this->companyId.' and t.delete_flag=0' ;
		$models = SiteType::model()->findAll($criteria);
		$this->render('index',array(
				'models'=>$models,
		));	
	}
	public function actionUpdate(){
		$id = Yii::app()->request->getParam('id');
		$model = Order::model()->with('company')->find('order_id=:id' , array(':id'=>$id));
		
		//var_dump($model);exit;
		if(Yii::app()->request->isPostRequest){
			$model->attributes = Yii::app()->request->getPost('Order');
			if($model->save()) {
				Yii::app()->user->setFlash('success','修改成功');
				$this->redirect(array('order/index' , 'companyId' => $this->companyId));
			}
		}
		$this->render('update' , array('model'=>$model));
	}
	public function actionGetOrderId(){
		$id = Yii::app()->request->getParam('id');
		$site = Site::model()->with('isfree')->find('t.site_id=:id' , array(':id' => $id));
		
		if($site->isfree) {
			$order = Order::model()->find('site_no_id=:id' , array(':id' => $site->isfree->id));
			echo json_encode(array('status'=>true , 'serial'=>$site->serial , 'order_id'=>$order->order_id));
		} else {
			echo json_encode(array('status'=>false));
		}
		exit;
	}
	public function actionPay(){
		$id = Yii::app()->request->getParam('id');
		$order = Order::model()->find('order_id=:id' , array(':id' => $id));
		$siteNo = SiteNo::model()->find('id=:id' , array(':id'=>$order->site_no_id));
		$order->order_status = 1;
		$order->pay_time = time();
		$siteNo->delete_flag = 1;
		
		if($order->save() && $siteNo->save()) {
			echo json_encode(array('status'=>true , 'siteId'=>$siteNo->site_id));
		} else {
			echo json_encode(array('status'=>false));
		}
		exit;
	}
	
}
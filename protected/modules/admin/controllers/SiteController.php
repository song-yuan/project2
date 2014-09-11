<?php
class SiteController extends BackendController
{
	public function actionIndex() {
		$companyId  = Yii::app()->request->getParam('companyId') ;
		if(!$companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司') ;
			$this->redirect(array('company/index')) ;
		}
		$companyId = Helper::getCompanyId($companyId);
		
		$criteria = new CDbCriteria;
		$criteria->with = array('site' , 'site.isfree') ;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 'company_id='.Yii::app()->user->companyId ;
		
		$models = SiteType::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'companyId' => $companyId
		));
	}
	public function actionCreate() {
		
	}
	public function actionUpdate () {
		
	}
	
}
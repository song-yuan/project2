<?php
class SiteTypeController extends BackendController
{
	public function actionIndex() {
		$companyId = Yii::app()->request->getParam('companyId') ;
		if(!$companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司');
			$this->redirect(array('company/index')) ;
		}
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$criteria = new CDbCriteria;
		$criteria->with = 'company';
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 'company_id='.Yii::app()->user->companyId ;
		
		$pages = new CPagination(SiteType::model()->count($criteria));
		//	    $pages->setPageSize(1);
		$pages->applyLimit($criteria);
		$models = SiteType::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages,
				'companyId' => $companyId
		));
	}
	public function actionCreate() {
		
	}
	public function actionUpdate() {
		
	}
	public function actionDelete() {
		
	}
}
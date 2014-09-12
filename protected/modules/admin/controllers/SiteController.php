<?php
class SiteController extends BackendController
{
	public function actionIndex() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		if(!$companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司') ;
			$this->redirect(array('company/index')) ;
		}
		
		$criteria = new CDbCriteria;
		$criteria->with = array('site' , 'site.isfree') ;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 't.company_id='.Yii::app()->user->companyId ;
		
		$models = SiteType::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'companyId' => $companyId
		));
	}
	public function actionCreate() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = new Site() ;
		$model->company_id = $companyId ;
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Site');
			$model->save();
			$this->redirect(array('site/index' , array('companyId' => $companyId)));
		}
		$types = $this->getTypes();
		$this->render('create' , array(
				'model' => $model , 
				'types' => $types
		));
	}
	private function getTypes(){
		$types = SiteType::model()->findAll('company_id=:companyId and delete_flag=0' , array(':companyId' => $this->companyId)) ;
		return CHtml::listData($types, 'type_id', 'name');
	}
}
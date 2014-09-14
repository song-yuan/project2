<?php
class SiteController extends BackendController
{
	public function beforeAction($action) {
		parent::beforeAction($action);
		if(!$this->companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司');
			$this->redirect(array('company/index'));
		}
		return true;
	}
	public function actionIndex() {
		$criteria = new CDbCriteria;
		$criteria->with = array('site' , 'site.isfree') ;
		$criteria->condition =  't.company_id='.$this->companyId ;
		
		$models = SiteType::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
		));
	}
	public function actionCreate() {
		$model = new Site() ;
		$model->company_id = $this->companyId ;
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Site');
			$model->save();
			$this->redirect(array('site/index' , 'companyId' => $this->companyId));
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
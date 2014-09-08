<?php
class UserController extends BackendController
{
	public function actionIndex() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$criteria = new CDbCriteria;
		$criteria->with = 'company' ;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 'company_id='.Yii::app()->user->companyId ;
		
		$pages = new CPagination(User::model()->count($criteria));
		//	    $pages->setPageSize(1);
		$pages->applyLimit($criteria);
		$models = User::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages,
				'companyId' => $companyId
		));
	}
	public function actionCreate() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = new UserForm() ;
		$model->company_id = $companyId ;
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('UserForm');
			$model->save();
			$this->redirect(array('user/index' , array('companyId' => $companyId)));
		}
		$this->render('create' , array('model' => $model));
	}
	public function actionUpdate() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$id = Yii::app()->request->getParam('id');
		$model = new UserForm();
		$model->find('id=:id', array(':id' => $id));
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('UserForm');
			$model->save();
			$this->redirect(array('user/index' , array('companyId' => $companyId)));
		}
		$this->render('update' , array('model' => $model)) ;
	}
	public function actionDelete() {
		
	}
}
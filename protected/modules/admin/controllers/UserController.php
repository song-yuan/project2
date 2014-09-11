<?php
class UserController extends BackendController
{
	public $roles ;
	public function init(){
		$this->roles = array(
			'2' => '管理员' ,
			'3' => '服务员',
		) ;
		if(Yii::app()->user->role == User::POWER_ADMIN) {
			$this->roles = array_merge(array(
				'1' => '系统管理员' ,
			) ,
			$this->roles);
		}
		$this->roles = array_merge(array(
				'0' => '-- 请选择 --' ,
		) ,
		$this->roles);
	}
	public function actionIndex() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$criteria = new CDbCriteria;
		$criteria->with = 'company' ;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 't.company_id='.Yii::app()->user->companyId ;
		
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
		$model = UserForm::model()->find('id=:id', array(':id' => $id));
		
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
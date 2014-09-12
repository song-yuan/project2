<?php
class BackendController extends CController
{
	public $layout = '/layouts/main_admin';
	public $companyId = 0;
	public function beforeAction($action) {
		$this->companyId = Yii::app()->request->getParam('companyId');
		$controllerId = Yii::app()->controller->getId();
		if(Yii::app()->user->isGuest && $controllerId != 'login') {
			$this->redirect(Yii::app()->params['admin_return_url']);
		}
		return true ;
	}
}
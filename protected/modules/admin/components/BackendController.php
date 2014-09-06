<?php
class BackendController extends CController
{
	public $layout = '/layouts/main_admin';
	public function beforeAction($action) {
		$controllerId = Yii::app()->controller->getId();
		if(Yii::app()->user->isGuest && $controllerId != 'login') {
			$this->redirect(Yii::app()->params['admin_return_url']);
		}
		return true ;
	}
}
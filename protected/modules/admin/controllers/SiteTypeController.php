<?php
class SiteTypeController extends BackendController
{
	public function actionIndex() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		if(!$companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司');
			$this->redirect(array('company/index')) ;
		}
		$criteria = new CDbCriteria;
		$criteria->with = 'company';
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 't.company_id='.Yii::app()->user->companyId ;
		
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
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = new SiteType() ;
		$model->company_id = $companyId ;
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('SiteType');
			$model->save();
			$this->redirect(array('siteType/index' , array('companyId' => $companyId)));
		}
		$this->render('create' , array(
			'model' => $model,
			'companyId' => $companyId
		));
	}
	public function actionUpdate() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$id = Yii::app()->request->getParam('id');
		$model = SiteType::model()->find('type_id=:id', array(':id' => $id));
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('SiteType');
			$model->save();
			$this->redirect(array('siteType/index' , array('companyId' => $companyId)));
		}
		$this->render('update' , array(
			'model' => $model
		));
	}
	public function actionDelete() {
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$ids = $_POST['type_id'] ;
		
		if(!empty($ids)) {
			Yii::app()->db->createCommand('update nb_site_type set delete_flag=1 where type_id in (:ids) and company_id = :companyId')
			->execute(array(':ids' => implode(',' , $ids) , ':companyId' => $companyId));
			
			Yii::app()->db->createCommand('update nb_site set delete_flag where type_id in (:ids) and company_id = :companyId')
			->execute(array(':ids' => implode(',' , $ids) , ':companyId' => $companyId));
		}
		$this->redirect(array('siteType/index' , array('companyId' => $companyId))) ;
	}
}
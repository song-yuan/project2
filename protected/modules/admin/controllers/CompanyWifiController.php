<?php
class CompanyWifiController extends BackendController
{
	public function actionIndex(){
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$criteria = new CDbCriteria;
		$criteria->with = 'company' ;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? '' : 't.company_id='.Yii::app()->user->companyId ;
		
		$pages = new CPagination(CompanyWifi::model()->count($criteria));
		//	    $pages->setPageSize(1);
		$pages->applyLimit($criteria);
		$models = CompanyWifi::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages,
				'companyId' => $companyId
		));
	}
	public function actionCreate(){
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = new CompanyWifi() ;
		$model->company_id = $companyId ;
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('CompanyWifi');
			if($model->save()){
				Yii::app()->user->setFlash('success' , '添加成功');
				$this->redirect(array('companyWifi/index' , 'companyId' => $companyId));
			}
		}
		$this->render('create' , array('model' => $model));
	}
	public function actionUpdate(){
		$id = Yii::app()->request->getParam('id');
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = CompanyWifi::model()->find('id=:id and company_id=:companyId' , array(':id' => $id , ':companyId' => $companyId));
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('CompanyWifi');
			if($model->save()){
				Yii::app()->user->setFlash('success' , '修改成功');
				$this->redirect(array('companyWifi/index' , 'companyId' => $companyId));
			}
		}
		$this->render('update' , array('model' => $model ));
	}
	public function actionDelete(){
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$ids = Yii::app()->request->getPost('ids');
		if(!empty($ids)) {
				foreach ($ids as $id) {
					$model = CompanyWifi::model()->find('id=:id and company_id=:companyId' , array(':id' => $id , ':companyId' => $companyId)) ;
					if($model) {
						$model->delete();
					}
				}
				$this->redirect(array('companyWifi/index' , 'companyId' => $companyId)) ;
		} else {
			Yii::app()->user->setFlash('error' , '请选择要删除的项目');
			$this->redirect(array('companyWifi/index' , 'companyId' => $companyId)) ;
		}
	}
	
}
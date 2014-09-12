<?php
class CompanyController extends BackendController
{
	public function actionIndex(){
		$criteria = new CDbCriteria;
		$criteria->condition = Yii::app()->user->role == User::POWER_ADMIN ? : 'company_id='.Yii::app()->user->companyId ;
		
		$pages = new CPagination(Company::model()->count($criteria));
		//	    $pages->setPageSize(1);
		$pages->applyLimit($criteria);
		$models = Company::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=> $models,
				'pages'=>$pages,
		));
	}
	public function actionCreate(){
		$model = new Company();
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Company');
			$file = CUploadedFile::getInstance($model,'logo');
			if(is_object($file)&&get_class($file) === 'CUploadedFile'){
				$model->logo = Helper::genFileName($model , $file);
			}
			if($model->save()){
				if(is_object($file)&&get_class($file) === 'CUploadedFile'){
					$file->saveAs($model->logo);
				}
				Yii::app()->user->setFlash('success','create successful');
				$this->redirect(array('company/index'));
			}
		}
		return $this->render('create',array('model' => $model));
	}
	public function actionUpdate(){
		$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$model = Company::model()->find('company_id=:companyId' , array(':companyId' => $companyId)) ;
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Company');
			if($model->validate()){
				$file = CUploadedFile::getInstance($model,'logo');
				if(is_object($file)&&get_class($file) === 'CUploadedFile'){
					$model->logo = Helper::genFileName($model , $file);
					$file->saveAs($model->logo);
				}
				$model->save();
				Yii::app()->user->setFlash('success','update successful');
				$this->redirect(array('company/index'));
			}
		}
		return $this->render('update',array('model'=>$model));
	}
	public function actionFreaze(){
		
	}
}
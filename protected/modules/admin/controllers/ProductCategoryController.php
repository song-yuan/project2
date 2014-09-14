<?php
class ProductCategoryController extends BackendController
{
	public function beforeAction($action) {
		parent::beforeAction($action);
		if(!$this->companyId) {
			Yii::app()->user->setFlash('error' , '请选择公司');
			$this->redirect(array('company/index'));
		}
		return true;
	}
	public function actionIndex(){
		//$companyId = Helper::getCompanyId(Yii::app()->request->getParam('companyId'));
		$criteria = new CDbCriteria;
		$criteria->with = 'company';
		$criteria->condition =  't.company_id='.$this->companyId ;
		
		$pages = new CPagination(ProductCategory::model()->count($criteria));
		//	    $pages->setPageSize(1);
		$pages->applyLimit($criteria);
		$models = ProductCategory::model()->findAll($criteria);
		
		$this->render('index',array(
				'models'=>$models,
				'pages'=>$pages,
		));
	}
	public function actionCreate() {
		$model = new ProductCategory() ;
		$model->company_id = $this->companyId ;
	
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('ProductCategory');
			$model->save();
			$this->redirect(array('productCategory/index' , 'companyId' => $this->companyId));
		}
		$this->render('create' , array(
				'model' => $model,
		));
	}
	public function actionUpdate() {
		$id = Yii::app()->request->getParam('id');
		$model = ProductCategory::model()->find('category_id=:id', array(':id' => $id));
	
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('ProductCategory');
			$model->save();
			$this->redirect(array('productCategory/index' , 'companyId' => $this->companyId));
		}
		$this->render('update' , array(
				'model' => $model
		));
	}
	public function actionDelete() {
		$ids = $_POST['ids'] ;
		if(!empty($ids)) {
			Yii::app()->db->createCommand('update nb_product_category set delete_flag=1 where category_id in (:ids) and company_id = :companyId')
			->execute(array(':ids' => implode(',' , $ids) , ':companyId' => $this->companyId));
				
			Yii::app()->db->createCommand('update nb_product set delete_flag where category_id in (:ids) and company_id = :companyId')
			->execute(array(':ids' => implode(',' , $ids) , ':companyId' => $this->companyId));
		}
		$this->redirect(array('siteType/index' , 'companyId' => $this->companyId)) ;
	}
	
	
	
}
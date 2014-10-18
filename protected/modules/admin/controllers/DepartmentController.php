<?php
class DepartmentController extends BackendController
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
		$models = Department::model()->findAll('company_id=:companyId',array('companyId'=>$this->companyId));
		$this->render('index',array(
				'models'=>$models
		));
	}
	public function actionCreate(){
		$model = new Department() ;
		$model->company_id = $this->companyId ;
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Department');
			if($model->save()) {
				Yii::app()->user->setFlash('success' , '添加成功');
				$this->redirect(array('department/index','companyId' => $this->companyId));
			}
		}
		$printers = $this->getPrinterList();
		$this->render('create' , array(
				'model' => $model ,
				'printers'=>$printers
		));
	}
	public function actionUpdate(){
		$id = Yii::app()->request->getParam('id');
		$model = Department::model()->findByPk($id);
		
		if(Yii::app()->request->isPostRequest) {
			$model->attributes = Yii::app()->request->getPost('Department');
			if($model->save()){
				Yii::app()->user->setFlash('success' , '修改成功');
				$this->redirect(array('department/index' , 'companyId' => $this->companyId));
			}
		}
		$printers = $this->getPrinterList();
		$this->render('update' , array(
				'model'=>$model,
				'printers'=>$printers
		));
	}
	public function actionDelete(){
		
	}
	private function getPrinterList(){
		$printers = Printer::model()->findAll('company_id=:companyId',array(':companyId'=>$this->companyId)) ;
		return CHtml::listData($printers, 'printer_id', 'name');
	}
}
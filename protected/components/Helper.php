<?php
class Helper
{
	static public function genPassword($password)
	{
			return md5(md5($password).Yii::app()->params['salt']);
	}
	static public function getCompanyId($companyId) {
		return Yii::app()->user->role == User::POWER_ADMIN ? $companyId : Yii::app()->user->companyId ;
	}
	static public function genFileName($model , $file){
		$baseDir = 'uploads/company_'.$model->company_id;
		if(!is_dir($baseDir)) {
			mkdir($baseDir);
		}
		$fileName = $baseDir.'/'.date('YmdHis',time()).rand(1000, 9999).'.'.$file->getExtensionName();
		return $fileName ;
	}
	static public function genCompanyOptions() {
		$companies = Company::model()->findAll('delete_flag=0') ;
		return CHtml::listData($companies, 'company_id', 'company_name');
	}
}
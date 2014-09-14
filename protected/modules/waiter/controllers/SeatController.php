<?php

class SeatController extends BaseWaiterController
{
	public $companyId;
	public $waiterId;
	public function init(){
	  $this->companyId = Yii::app()->user->companyId;	
	  $this->waiterId = Yii::app()->user->userId;	
	}
	public function actionIndex()
	{
		$db = Yii::app()->db;
		$id = Yii::app()->request->getParam('id',0);
		$typeSql = 'select * from nb_site_type where company_id='.$this->companyId;
		$siteType = $db->createCommand($typeSql)->queryAll();
		if(!$id){
			$id = $siteType?$siteType[0]['type_id']:0;
		}
		$sql = 'select t1.*,t2.code from nb_site as t1 left join (select * from nb_site_no where company_id='.$this->companyId.' and delete_flag=0)t2 on t1.site_id = t2.site_id where t1.company_id='.$this->companyId.' and t1.type_id='.$id;
		$models = $db->createCommand($sql)->queryAll();
		$this->render('index',array('models'=>$models,'siteType'=>$siteType,'id'=>$id));
	}
	/**
	 * 
	 * 生成座次号
	 */
	public function actionCreateCode(){
		$id = Yii::app()->request->getParam('id');
		$model = SiteNo::model()->find('site_id=:siteId and company_id=:companyId and delete_flag=0',array(':siteId'=>$id,':companyId'=>$this->companyId));
		$model = $model?$model:new SiteNo;
		$code = rand(100000,999999);
		$model->company_id = $this->companyId;
		$model->site_id  = $id;
		$model->code = $code;
		$model->waiter_id = $this->waiterId;
		if($model->save()){
		   echo $code;
		}else{
			echo 0;
		}
		Yii::app()->end();
	}

}
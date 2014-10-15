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
	static public function genCompanyOptions() {
		$companies = Company::model()->findAll('delete_flag=0') ;
		return CHtml::listData($companies, 'company_id', 'company_name');
	}
	//生成文件名字
	static public function genFileName(){
		if (function_exists('com_create_guid') === true)
		{
			return trim(com_create_guid(), '{}');
		}
		return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X', mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(16384, 20479), mt_rand(32768, 49151), mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
	}
	static public function getCategories($companyId,$pid=0){
		$command = Yii::app()->db->createCommand('select * from nb_product_category where company_id=:companyId and pid=:pid and delete_flag=0');
		$command->bindValue(':companyId',$companyId);
		$command->bindValue(':pid',$pid);
		return $command->queryAll();
	}
	//计算order的总价
	static public function calOrderConsume(Order $order , $total){
		$siteNo = SiteNo::model()->findByPk($order->site_no_id);
		$site = Site::model()->findByPk($siteNo->site_id);
		if(!$site->has_minimum_consumption) {
			return $total;
		}
		$siteFee = 0;
		if($site->minimum_consumption_type == 1) {
			//按时间收费
			$orderTime = $order->pay_time - $order->create_time ;
			$overtime = $orderTime - $site->period ;
			$overtimeTimes = 0 ;
			$buffer = $site->buffer*3600 ;
			$siteOvertime = $site->overtime * 3600 ;
			
			if($overtime < $buffer){
				$overtimeTimes = 0 ;
			}else {
				$mod = intval($overtime / $siteOvertime) ;
				$remainder = $overtime % $siteOvertime ;
				$overtimeTimes = $mod + ($remainder >= $buffer ? 1 : 0);
			}
			$siteFee = $site->minimum_consumption + $site->overtime_fee * $overtimeTimes ;
		}elseif($site->minimum_consumption_type == 2) {
			//按人头收费
			$siteFee = $site->minimum_consumption * $order->number ;
		}
		return $siteFee > $total ? $siteFee : $total ;
	}
	//打印清单写入到redis
	static public function printList(Order $order){
		
		
	}
	//操作间打印数据写入到redis
	static public function printProducts(array $products){
		
		
	}
}
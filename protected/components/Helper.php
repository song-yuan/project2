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
	//计算order的总价array('total'=>'总价','miniConsumeType'=>'最低消费类型','miniConsume'=>'最低消费','overTime'=>'超时时间','siteOverTime'=>'超时计算单位','buffer'=>'超时计算点','number'=>'人数')
	static public function calOrderConsume(Order $order , $total){
		$siteNo = SiteNo::model()->findByPk($order->site_no_id);
		$site = Site::model()->findByPk($siteNo->site_id);
		$result = array('total'=>$total,'remark'=>'');
		if(!$site->has_minimum_consumption) {
			return $result;
		}
		if($site->minimum_consumption_type == 0) {
			//按时间收费
			$payTime = $order->pay_time ? $order->pay_time : time() ;
			$orderTime = $payTime - $order->create_time ;
			$overtime = $orderTime - $site->period*60 ;
			$overtimeTimes = 0 ;
			$buffer = $site->buffer*60 ;
			$siteOvertime = $site->overtime * 60 ;
			
			if($overtime < $buffer){
				$overtimeTimes = 0 ;
			}else {
				$mod = intval($overtime / $siteOvertime) ;
				$remainder = $overtime % $siteOvertime ;
				$overtimeTimes = $mod + ($remainder >= $buffer ? 1 : 0);
			}
			$result = array(
					'total' => $site->minimum_consumption + $site->overtime_fee * $overtimeTimes ,
					'remark'=>"按时计费，最低消费{$site->minimum_consumption}元/{$site->period}分钟，超时每{$site->overtime}分钟收费{$site->overtime_fee}元，超出{$site->buffer}分钟按{$site->overtime}分钟计算。",
			);
		}elseif($site->minimum_consumption_type == 1) {
			//按人头收费
			$result = array(
					'total' => $site->minimum_consumption * $order->number,
					'remark'=>"按人数计费，最低消费{$site->minimum_consumption}元/人，每增加一人收取{$site->minimum_consumption}元（实际总人数{$order->number}）",
			);
		}
		$result['total'] = $result['total'] > $total ? $result['total'] : $total ;
		return $result;
	}
	/**
	 * 
	 * 最低消费说明
	 * 
	 */
	static public function lowConsumeInfo($siteId){
		$site = Site::model()->findByPk($siteId);
		$result = array('total'=>0,'remark'=>'');
		if(!$site->has_minimum_consumption) {
			$result['remark'] = '无最低消费';
			return $result;
		}
		if($site->minimum_consumption_type == 0) {
			//按时间收费
			$result = array(
					'total' => 0,
					'remark'=>"按时计费，最低消费{$site->minimum_consumption}元/{$site->period}分钟，超时每{$site->overtime}分钟收费{$site->overtime_fee}元，超出{$site->buffer}分钟按{$site->overtime}分钟计算。",
			);
		}elseif($site->minimum_consumption_type == 1) {
			//按人头收费
			$result = array(
					'total' => 0,
					'remark'=>"按人数计费，最低消费{$site->minimum_consumption}元/人，每增加一人收取{$site->minimum_consumption}元（实际总人数{$order->number}）",
			);
		}
		return $result;
	}
	//打印清单写入到redis
	static public function printList(Order $order , $reprint = false){
		$printerId = $order->company->printer_id;
		$printer = Printer::model()->findByPk($printerId);
		$orderProducts = OrderProduct::getOrderProducts($order->order_id);
		$siteNo = SiteNo::model()->findByPk($order->site_no_id);
		$site = Site::model()->findByPk($siteNo->site_id);
		$siteType = SiteType::model()->findByPk($site->type_id);
		
		$listKey = $order->company_id.'_'.$printer->ip_address;
		$list = new ARedisList($listKey);
		if($reprint) {
			$listData[] = str_pad('丢单重打', 48 , ' ').'\r\n';
		}
		$listData[] = str_pad($order->company->company_name, 48 , ' ' ,STR_PAD_BOTH);
		$listData[] = str_pad('座号：'.$siteType->name.' '.$site->serial , 20,' ').str_pad('人数：'.$order->number,20,' ').'\r\n';
		$listData[] = str_pad('',48,'-');
		
		foreach ($orderProducts as $product) {
			$listData[] = str_pad($product['product_name'],20,' ').str_pad($product['amount'].'份',8,' ').str_pad($product['amount']*$product['price'] , 8 , ' ').str_pad($product['amount']*$product['price'] , 8 , ' ').'\r\n';	
		}
		if(!empty($listData)){
			$list->unshift($listData);
		}
	}
}
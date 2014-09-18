<?php
/* @var $this ProductController */
	Yii::app()->clientScript->registerCssFile('css/cartlist.css');
?>
	<div class="title">
	  <div class="seatnum"><?php echo $seatNum;?></div>
	</div>
	<div class="clear"></div>
	<div class="orderlist">
	 <div class="order-cat">
	  <div class="cat-left">订单总价:</div>
	  <div class="cat-right">共<?php echo $totalPrice[0];?>元</div>
	 </div>
	  <div class="clear"></div>
	  <?php if($orderProducts):?>
	  <?php 
	  		foreach($orderProducts as $product): 
	  ?>
	  <div class="order">
	    <div class="order-left"><img src="<?php echo $product['main_picture'];?>" style="height:100%"/></div>
	    <div class="order-middle">
	      <lable><?php echo $product['product_name'];?></lable><br/>
	      <lable>数量:<?php echo $product['product_num'];?></lable><lable>  总金额:<?php echo $product['product_num']*$product['price']*$product['amount'];?></lable><br/>
	      <lable>下单时间:<?php echo date('Y-m-d H:i:s',$product['create_time']);?></lable>
	    </div>
	    <div class="order-right"></div>
	  </div>
	 <?php 
	   endforeach;
	 ?>
	 <?php endif;?>
	</div>
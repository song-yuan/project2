<?php
/* @var $this ProductController */
	Yii::app()->clientScript->registerCssFile('css/cartlist.css');
?>
<form action="" method="post">
	<div class="title">
	  <div class="seatnum"><?php echo $seatnum;?></div>
	  <div class="orderbtn">下单</div>
	</div>
	<div class="clear"></div>
	<div class="orderlist">
	 <div class="order-cat">
	  <div class="cat-left">订单总价:</div>
	  <div class="cat-right">共2000元</div>
	 </div>
	  <div class="clear"></div>
	  <?php if($cartLists):?>
	  <?php $totalprice = 0; foreach($cartLists as $cartList): $totalprice +=$cartList->product_num*$cartList->product->price;?>
	  <div class="order">
	    <div class="order-left"><img src="<?php echo $cartList->product->main_picture;?>" style="height:100%"/></div>
	    <div class="order-middle">
	      <lable><?php echo $cartList->product->product_name;?></lable><br/>
	      <lable>数量:<?php echo $cartList->product_num;?></lable><lable>  总金额:<?php echo $cartList->product_num*$cartList->product->price;?></lable><br/>
	      <lable>下单时间:<?php echo date('Y-m-d H:i:s',$cartList->create_time);?></lable>
	    </div>
	    <div class="order-right"><div class="delete"></div></div>
	  </div>
	 <?php endforeach;?>
	 <input type="hidden" id="totalprice" value="<?php echo$totalprice;?>"/>
	 <?php endif;?>
	</div>
</form>
<script type="text/javascript">
function getTotal(){
	var price = $('#totalprice').val();
	if(price==undefined){
		price = 0;
	}
	$('.cat-right').html('共'+price+'元');
}
$(document).ready(function(){
    window.load = getTotal();
})
</script>

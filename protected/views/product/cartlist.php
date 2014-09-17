<?php
/* @var $this ProductController */
	Yii::app()->clientScript->registerCssFile('css/cartlist.css');
?>
	<div class="title">
	  <div class="seatnum"><?php echo $seatnum;?></div>
	  <a href="javascript:;"><div class="orderbtn">下单</div></a>
	</div>
	<div class="clear"></div>
	<div class="orderlist">
	 <div class="order-cat">
	  <div class="cat-left">订单总价:</div>
	  <div class="cat-right">共2000元</div>
	 </div>
	  <div class="clear"></div>
	  <?php if($cartLists):?>
	  <?php 
	  		$totalprice = 0; 
	  		$products = array();
	  		foreach($cartLists as $cartList): 
	         $totalprice +=$cartList->product_num*$cartList->product->price;
	         $product = array('product_id'=>$cartList->product->product_id,'product_num'=>$cartList->product_num,'price'=>$cartList->product_num*$cartList->product->price);
	         array_push($products,$product);
	  ?>
	  <div class="order">
	    <div class="order-left"><img src="<?php echo $cartList->product->main_picture;?>" style="height:100%"/></div>
	    <div class="order-middle">
	      <lable><?php echo $cartList->product->product_name;?></lable><br/>
	      <lable>数量:<?php echo $cartList->product_num;?></lable><lable>  总金额:<?php echo $cartList->product_num*$cartList->product->price;?></lable><br/>
	      <lable>下单时间:<?php echo date('Y-m-d H:i:s',$cartList->create_time);?></lable>
	    </div>
	    <div class="order-right"><a href="<?php echo $this->createUrl('product/deleteCart',array('id'=>$cartList->cart_id));?>"><div class="delete"></div></a></div>
	  </div>
	 <?php 
	   endforeach;
	   $jsonproducts = json_encode($products);
	 ?>
	 <input type="hidden" id="totalprice" value="<?php echo$totalprice;?>"/>
	 <?php endif;?>
	</div>
<script type="text/javascript">
var products = [];
var jsonproduct = <?php echo isset($jsonproducts)?$jsonproducts:0;?>;
function parseData(){
	for(var i in jsonproduct){
		var product = [];
		product.push(jsonproduct[i].product_id,jsonproduct[i].product_num,jsonproduct[i].price);
		products[i] = product;
	}
}
function getTotal(){
	var price = $('#totalprice').val();
	if(price==undefined){
		price = 0;
	}
	$('.cat-right').html('共'+price+'元');
	parseData();
}
$(document).ready(function(){
    window.load = getTotal();
    $('.orderbtn').click(function(){
    	$.ajax({
    		url:'<?php echo $this->createUrl('/product/createOrder')?>',
    		type:'POST',
    		data:'products='+products+'&code='+123456,
    		success:function(msg){
    			alert(msg);
    		},
    		dataType:'JSON',
    	});
    });
})
</script>

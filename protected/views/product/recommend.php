<?php
/* @var $this ProductController */
Yii::app()->clientScript->registerCssFile('css/product.css');
?>
<div class="productlist">
<?php if($products):?>
<?php foreach($products as $product):?>
  <div class="product">
    <div class="productimg">
      <img src="<?php echo $product['main_picture'];?>" width="100%" height="100%"/>
      <div class="productbuy">
      	<div class="inmiddle">
	       <a class="numminus" href="javascript:;">-</a>
	       <input type="text" class="num" name="product_num" maxlength="8" value="1"/>
	       <a class="numplus" href="javascript:;">+</a>
	    </div>
      </div>
    </div>
    <div class="productname">
     <div class="name"><?php echo $product['product_name'];?></div>
     <div class="price">￥<?php echo $product['price'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;原价:<strike><?php echo $product['origin_price'];?></strike></div>
    </div>
  </div>
  <?php endforeach;?>
  <?php endif;?>
  <div class="clear"></div>
</div>
<script type="text/javascript">
 $(document).ready(function(){
 	Flipsnap('.inner'); 
 	Flipsnap('.inner',{
            distance:100    //每次移动的距离
        });
 	 $('.productbuy').on('click','.numplus',function(){
    	var id = $(this).attr('product-id');
 		var numObj = $(this).siblings('.num');
 		var numVal = parseInt(numObj.val());
 		$.ajax({
 			url:'<?php echo $this->createUrl('/product/createCart');?>&id='+id,
 			success:function(msg){
 				if(msg==1){
 					numVal += 1;
 					numObj.val(numVal); 
 				}else if(msg==2){
 					location.href="<?php echo $this->createUrl('/product/insertSeatNum');?>";
 				}
 			},
 		});
    });
 	
     $('.productbuy').on('click','.numminus',function(){
     	var id = $(this).attr('product-id');
 		var numObj = $(this).siblings('.num');
 		var numVal = parseInt(numObj.val());
 		if(numVal>0){
 			$.ajax({
 			url:'<?php echo $this->createUrl('/product/deleteCartProduct');?>&id='+id,
 			success:function(msg){
 				if(msg){
 					numVal -= 1;
 					numObj.val(numVal);
 				}
 			},
 		});
 		}
     });
 });
</script>
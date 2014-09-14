<?php
/* @var $this ProductController */
Yii::app()->clientScript->registerCssFile('css/product.css');
?>
<div class="productcate">
<?php if($categorys):?>
<?php foreach($categorys as $category):?>
  <a href="<?php echo $this->createUrl('/product/index',array('category'=>$category['category_id']));?>"><div class="catename <?php if($category['category_id']==$categoryId) echo 'active';?>"><?php echo $category['category_name'];?></div></a>
<?php endforeach;?>
<?php endif;?>
</div>
<div class="productlist">
<?php if($products):?>
<?php foreach($products as $product):?>
  <div class="product">
    <div class="productimg">
      <img src="<?php echo $product['main_picture'];?>" width="100%" height="100%"/>
      <div class="productbuy">
	       <a class="numminus" href="javascript:;">-</a>
	       <input type="text" class="num" name="product_num" maxlength="8" value="1"/>
	       <a class="numplus" href="javascript:;">+</a>
       	   <a href="javascript:;">
       	     <div class="choose" product-id="<?php echo $product['product_id'];?>" origin_price="<?php echo $product['origin_price'];?>" price="<?php echo $product['price'];?>">点单</div>
       	   </a>
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
 	$('.numplus').click(function(){
 		var numObj = $(this).siblings('.num');
 		var numVal = parseInt(numObj.val());
 		numVal += 1; 
 		numObj.val(numVal);
 	});
 	$('.numminus').click(function(){
 		var numObj = $(this).siblings('.num');
 		var numVal = parseInt(numObj.val());
 		if(numVal>1){
 			numVal -= 1; 
 		}
 		numObj.val(numVal);
 	});
 	$('.choose').click(function(){
 		var id = $(this).attr('product-id');
 		var num = $(this).parent().siblings('.num').val();
 		alert(num);
 		$.ajax({
 			url:'<?php echo $this->createUrl('/product/createCart');?>',
 			type:'POST',
 			data:'id='+productId+'&num='+num,
 			success:function(msg){
 				if(msg){
 					alert('点单成功!');
 				}else{
 					alert('请重新点单!');
 				}
 				location.href="<?php echo $this->createUrl('/product/index');?>";
 			},
 		});
 	})
 });
</script>
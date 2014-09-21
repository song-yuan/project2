<?php
/* @var $this ProductController */
	Yii::app()->clientScript->registerCssFile('css/product.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-btn.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-img.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-list.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-base.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-box.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-color.css');
	Yii::app()->clientScript->registerCssFile('css/product/pic.css');
	Yii::app()->clientScript->registerCssFile('css/product/ui-media.css'); 
	Yii::app()->clientScript->registerScriptFile('js/product/zepto.js');
	Yii::app()->clientScript->registerScriptFile('js/product/base64.js'); 
	Yii::app()->clientScript->registerScriptFile('js/product/pic.js');  		 	
?>
<div class="productcate">
	<div class="inner" >
    <a href="<?php echo $this->createUrl('/product/productCategory');?>"><div class="catename back">返回</div></a>
	<?php if($categorys):?>
	<?php foreach($categorys as $category):?>
	  <a href="<?php echo $this->createUrl('/product/index',array('pid'=>$pid,'category'=>$category['category_id']));?>"><div class="catename <?php if($category['category_id']==$categoryId) echo 'active';?>"><?php echo $category['category_name'];?></div></a>
	<?php endforeach;?>
	</div>
	<?php endif;?>
	<div class="clear"></div>
</div>
<div id="page_0" class="up ub ub-ver" tabindex="0">
			<!--content开始-->
            <div id="content" class="ub-f1 tx-l t-bla ub-img6 res10">
				<div id="forum_list">
					<div class="outDiv" id="leftPic">
					</div>
					<div class="outDiv" id="rightPic">
					</div>
					
				</div>
				<!--列表结束-->
				<button class="foot" id="nextpage" ontouchstart="zy_touch('btn-newact')" onclick="getMorePic(<?php echo $categoryId;?>);">查看下8条</button>
				<div style="text-align:center;height:0.5em;">&nbsp;</div>

            </div>
            <!--content结束-->
        </div>
<script type="text/javascript">
	var cat =<?php echo $categoryId;?>;
	function cateWidth(){
		var width = 0;
		var count = $('.catename').length;
		for(var i=0;i<count;i++){
			width += $('.catename').eq(i).width();
		}
		width += 140;
		$('.inner').css('width',width+'px');
	}
	window.onload=function(type)
	{
		type = cat;
		cateWidth();
		getPicList(type);
	}	
 $(document).ready(function(){
 	Flipsnap('.inner'); 
 	Flipsnap('.inner',{
            distance:100    //每次移动的距离
     });
      
    $('#forum_list').on('click','.numplus',function(){
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
 	
     $('#forum_list').on('click','.numminus',function(){
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
 	$(window).on('touchend',function(e){
		var a = document.body.scrollHeight;
		var b = document.documentElement.clientHeight;
		var c = document.documentElement.scrollTop + document.body.scrollTop;
		//var c = document.documentElement.scrollTop || window.pageYOffset || document.body.scrollTop;
		var totalHeight = c+b+30;
		if(totalHeight >= a ){
			$('#nextpage').text('数据加载中……');
			getMorePic(cat);
		} 
	})
 });
</script>
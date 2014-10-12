<?php
/* @var $this SeatController */

?>
<div class="up"><div class="title">开台号</div><a href="javascript:;"><div class="btn createsite">开台</div></a><a href="javascript:;"><div class="openseat">点单</div></a></div>
<div class="clear"></div>
<div class="sitelist">
	<div class="siteup">
	 <div class="inner" style="width:<?php echo count($siteType)*52+20;?>px;">
	 <?php foreach($siteType as $type):?>
	  <a href="<?php echo $this->createUrl('/waiter/seat/index',array('id'=>$type['type_id']));?>">
	   <div class="sitecat <?php if($type['type_id']==$id) echo 'active';?>" ><?php echo $type['name'];?></div>
	  </a>
	  <?php endforeach;?>
	  </div>
	  <div class="clear"></div>
   </div>
   <div class="sitedown">
   <?php foreach($models as $model):?>
   	 <div class="sitename <?php if($model['code']) echo 'hascode';?>" data-id="<?php echo $model['site_id'];?>" code="<?php echo $model['code'];?>" order-id="<?php echo $model['order_id'];?>"><?php echo $model['serial'].'('.$model['site_level'].')';?></div>
   	 <?php endforeach;?>
   	 <div class="clear"></div>
   </div>

</div>
<script>
	$(document).ready(function(){
		Flipsnap('.inner'); 
	 	Flipsnap('.inner',{
	            distance:100    //每次移动的距离
	        });
        $('.sitecat').click(function(){
            if($('.sitecat').hasClass('active')){
            	$('.sitecat').removeClass('active');
            	$(this).addClass('active');
            }else{
            	$(this).addClass('active');
            }
        });
         $('.sitename').click(function(){
         	var code = $(this).attr('code');
         	var orderId = $(this).attr('order-id');
         	$('.openseat').attr('code',code);
         	$('.openseat').attr('order-id',orderId);
         	if(code==""){
         		code = "座次号";
         		$('.openseat').html('下单');
         	}
         	if(orderId){
         		$('.openseat').html('查看');
         	}
         	$('.title').html(code);
            if($('.sitename').hasClass('active')){
            	$('.sitename').removeClass('active');
            	$(this).addClass('active');
            }else{
            	$(this).addClass('active');
            }
        });
        $('.createsite').click(function(){
        	var seatobj = $('.sitedown').find('.active');
        	var id = seatobj.attr('data-id');
        	if(id==undefined){
        		alert('请选择座位!');
        	}else{
        		if(seatobj.hasClass('hascode')){
        			alert('结单后才能重新生成座次号！');
        			return ;
        		}else{
        			$.ajax({
	        		url:'<?php echo $this->createUrl('/waiter/seat/createCode');?>&id='+id,
	        		type:'POST',
	        		success:function(msg){
	        			$('.title').html(msg);
	        		 }
	        	    });
        		}
        	}
        });
        $('.openseat').click(function(){
        	var code = $(this).attr('code');
        	if(code==""){
        		alert('请先开台,然后再下单!');
        		return;
        	}
        	window.location.href = '<?php echo $this->createUrl('/product/productCategory');?>'
        });
	});
</script>

<?php
/* @var $this SeatController */

?>
<div class="title">座次号</div><div class="btn createsite">生成座次号</div>
<div class="clear"></div>
<div class="sitelist">
	<div class="siteup">
	 <div class="left"><img src="img/waiter/u13.png" width="32px" height="32px"/></div>
	 <?php foreach($siteType as $type):?>
	  <a href="<?php echo $this->createUrl('/waiter/seat/index',array('id'=>$type['type_id']));?>">
	   <div class="sitecat <?php if($type['type_id']==$id) echo 'active';?>" ><?php echo $type['serial'];?></div>
	  </a>
	  <?php endforeach;?>
	  <div class="right"><img src="img/waiter/u11.png" width="32px" height="32px"/></div>
	  <div class="clear"></div>
   </div>
   <div class="sitedown">
   <?php foreach($models as $model):?>
   	 <div class="sitename <?php if($model['code']) echo 'hascode';?>" data-id="<?php echo $model['site_id'];?>" code="<?php echo $model['code'];?>"><?php echo $model['serial'];?></div>
   	 <?php endforeach;?>
   	 <div class="clear"></div>
   </div>

</div>
<script>
	$(document).ready(function(){
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
         	if(code==""){
         		code = "座次号";
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
        	var id = $('.sitedown').find('.active').attr('data-id');
        	if(id==undefined){
        		alert('请选择座位!');
        	}else{
        		$.ajax({
        		url:'<?php echo $this->createUrl('/waiter/seat/createCode');?>&id='+id,
        		type:'POST',
        		success:function(msg){
        			$('.title').html(msg);
        		 }
        	    });
        	}
        });
	});
</script>

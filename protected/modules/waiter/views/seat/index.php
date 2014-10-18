<?php
/* @var $this SeatController */

?>
<div class="up"><div class="title">开台号</div><input type="text" class="site-number" size="2" placeholder="人数" value=""/><a href="javascript:;"><div class="btn createsite">开台</div></a><a href="javascript:;"><div class="openseat">查看</div></a></div>
<div class="clear"></div>
<div class="sitelist">
	<div class="siteup">
	 <?php foreach($siteType as $type):?>
	  <a href="<?php echo $this->createUrl('/waiter/seat/index',array('id'=>$type['type_id']));?>">
	   <div class="sitecat <?php if($type['type_id']==$id) echo 'active';?>" ><?php echo $type['name'];?></div>
	  </a>
	  <?php endforeach;?>
	  <div class="clear"></div>
   </div>
   <div class="sitedown">
   <?php foreach($models as $model):?>
   	 <div class="sitename <?php if($model['code']) echo 'hascode';?>" data-id="<?php echo $model['site_id'];?>" code="<?php echo $model['code'];?>" order-id="<?php echo $model['order_id'];?>" number="<?php echo $model['number'];?>"><?php echo $model['serial'].$model['site_level'];?></div>
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
         	var number = $(this).attr('number');
         	$('.openseat').attr('code',code);
         	if(code==""){
         		code = "开台号";
         	}
         	$('.title').html(code);
         	$('.site-number').val(number);
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
        	var number= $('.site-number').val();
        	if(number < 1 ||isNaN(number)){
        		alert('请输入人数')
        		return;
        	}
        	if(id==undefined){
        		alert('请选择座位!');
        		return;
        	}else{
        		if(seatobj.hasClass('hascode')){
        			alert('结单后才能重新生成开台号！');
        			return ;
        		}else{
        			$.ajax({
	        		url:'<?php echo $this->createUrl('/waiter/seat/createCode');?>&id='+id+'&number='+number,
	        		type:'POST',
	        		success:function(msg){
	        			$('.title').html(msg);
	        			seatobj.addClass('hascode');
	        			  $('.openseat').attr('code',msg);
	        		 }
	        	    });
        		}
        	}
        });
        $('.openseat').click(function(){
        	var code = $(this).attr('code');
        	if(code==""||code==undefined){
        		alert('请先开台,然后再查看!');
        		return;
        	}
        	window.location.href = '<?php echo $this->createUrl('/product/cartList');?>&code='+code+'&type='+1;
        });
	});
</script>

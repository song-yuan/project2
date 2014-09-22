<?php
/* @var $this ProductController */
Yii::app()->clientScript->registerCssFile('css/insertseatnum.css');
?>
<form action="" method="post">
<div class="form-group">
  <div class="left-text">提示:请输入服务员给您的座次号才能点单！！</div>
  <div class="right-ipt"><input type="text" class="inpt" name="seatnum" value="" maxlength="10" placeholder="请输入服务员提供的座次号" /></div>
  <div class="error"><?php echo $error;?></div>
<input type="hidden" name="referUrl" value="<?php echo $url;?>"/>
</div>
<div class="form-group">
  <div class="subdiv"><input type="submit" class="submitbtn" value="确 定" /></div>
</div>
</form>
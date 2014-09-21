<?php
/* @var $this ProductController */
Yii::app()->clientScript->registerCssFile('css/insertseatnum.css');
?>
<form action="" method="post">
<div class="form-group">
  <div class="left-text">请输入座次号:</div>
  <div class="right-ipt"><input type="text" class="inpt" name="seatnum" value="" maxlength="10" /></div>
<input type="hidden" name="referUrl" value="<?php echo $url;?>"/>
<div class="clear"></div>
</div>
<div class="form-group">
  <div class="left-text"></div>
  <div class="right-ipt"><input type="submit" class="submitbtn" value="确 定" /></div>
<div class="clear"></div>
</div>
<div class="form-group">
<div class="info">提示:请输入服务员给您的座次号才能点单！！</div>
</div>
</form>
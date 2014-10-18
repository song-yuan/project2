<?php
/* @var $this ProductController */
Yii::app()->clientScript->registerCssFile('css/product/category.css');
?>
<?php if($parentCategorys):?>
<?php foreach($parentCategorys as $category):?>
<a href="<?php echo $this->createUrl('/product/index',array('pid'=>$category['category_id'],'type'=>$type));?>"><div class="category"><?php echo $category['category_name'];?></div></a>
<?php endforeach;?>
<?php endif;?>
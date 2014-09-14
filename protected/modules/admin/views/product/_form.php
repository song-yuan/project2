							<?php $form=$this->beginWidget('CActiveForm', array(
									'id' => 'product-form',
									'errorMessageCssClass' => 'help-block',
									'htmlOptions' => array(
										'class' => 'form-horizontal',
										'enctype' => 'multipart/form-data'
									),
							)); ?>
								<div class="form-body">
									<div class="form-group  <?php if($model->hasErrors('category_id')) echo 'has-error';?>">
										<?php echo $form->label($model, 'category_id',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->dropDownList($model, 'category_id', array_merge(array('0' => '-- 请选择 --') , $categories) , array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('category_id')));?>
											<?php echo $form->error($model, 'category_id' )?>
										</div>
									</div>
								
									<div class="form-group <?php if($model->hasErrors('product_name')) echo 'has-error';?>">
										<?php echo $form->label($model, 'product_name',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'product_name',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('product_name')));?>
											<?php echo $form->error($model, 'product_name' )?>
										</div>
									</div>
									<div class="form-group <?php if($model->hasErrors('main_picture')) echo 'has-error';?>">
										<?php echo $form->label($model,'main_picture',array('class'=>'control-label col-md-3')); ?>
										<div class="col-md-9">
										<?php
										$this->widget('application.extensions.swfupload.SWFUpload',array(
											'callbackJS'=>'swfupload_callback',
											'fileTypes'=> '*.jpg',
											'buttonText'=> '上传产品图片',
											'companyId' => $model->company_id,
											'imgUrlList' => array($model->main_picture),
										));
										?>
										<?php echo $form->hiddenField($model,'main_picture'); ?>
										<?php echo $form->error($model,'main_picture'); ?>
										</div>
									</div>
						
									<div class="form-group" <?php if($model->hasErrors('origin_price')) echo 'has-error';?>>
										<?php echo $form->label($model, 'origin_price',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'origin_price',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('origin_price')));?>
											<?php echo $form->error($model, 'origin_price' )?>
										</div>
									</div>
									<div class="form-group" <?php if($model->hasErrors('price')) echo 'has-error';?>>
										<?php echo $form->label($model, 'price',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'price',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('price')));?>
											<?php echo $form->error($model, 'price' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'recommend',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->dropDownList($model, 'recommend', array('0' => '默认不推荐' , '1' => '推荐') , array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('category_id')));?>
											<?php echo $form->error($model, 'recommend' )?>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn blue">确定</button>
											<a href="<?php echo $this->createUrl('product/index' , array('companyId' => $model->company_id));?>" class="btn default">返回</a>                              
										</div>
									</div>
							<?php $this->endWidget(); ?>		
	<script>
		function swfupload_callback(name,path,oldname)  {
			$("#Product_main_picture").val(name);
			$("#thumbnails_1").html("<img src='"+name+"?"+(new Date()).getTime()+"' />"); 
		}
	</script>
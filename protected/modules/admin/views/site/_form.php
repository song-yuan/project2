							<?php $form=$this->beginWidget('CActiveForm', array(
									'id' => 'site-form',
									'errorMessageCssClass' => 'help-block',
									'htmlOptions' => array(
										'class' => 'form-horizontal',
										'enctype' => 'multipart/form-data'
									),
							)); ?>
								<div class="form-body">
								<?php if(!$model->company_id):?>
									<div class="form-group">
										<?php echo $form->label($model, 'company_id',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->dropDownList($model, 'company_id', array('0' => '-- 请选择 --') +Helper::genCompanyOptions() ,array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('company_id')));?>
											<?php echo $form->error($model, 'company_id' )?>
										</div>
									</div>
								<?php endif;?>
									<div class="form-group">
										<?php echo $form->label($model, 'type_id',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->dropDownList($model, 'type_id', array('0' => '-- 请选择 --') +$types ,array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('type_id')));?>
											<?php echo $form->error($model, 'type_id' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'site_level',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'site_level',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('site_level')));?>
											<?php echo $form->error($model, 'site_level' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'serial',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'serial',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('serial')));?>
											<?php echo $form->error($model, 'serial' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'has_minimum_consumption',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'has_minimum_consumption',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('has_minimum_consumption')));?>
											<?php echo $form->error($model, 'has_minimum_consumption' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'minimum_consumption_type',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'minimum_consumption_type',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('minimum_consumption_type')));?>
											<?php echo $form->error($model, 'minimum_consumption_type' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'minimum_consumption',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'minimum_consumption',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('minimum_consumption')));?>
											<?php echo $form->error($model, 'minimum_consumption' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'number',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'number',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('number')));?>
											<?php echo $form->error($model, 'number' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'period',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'period',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('period')));?>
											<?php echo $form->error($model, 'period' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'overtime',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'overtime',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('overtime')));?>
											<?php echo $form->error($model, 'overtime' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'buffer',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'buffer',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('buffer')));?>
											<?php echo $form->error($model, 'buffer' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'overtime_fee',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'overtime_fee',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('overtime_fee')));?>
											<?php echo $form->error($model, 'overtime_fee' )?>
										</div>
									</div>
									
									
									
									
									
									
									<div class="form-actions fluid">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn blue">确定</button>
											<a href="<?php echo $this->createUrl('site/index' , array('companyId' => $model->company_id));?>" class="btn default">返回</a>                              
										</div>
									</div>
							<?php $this->endWidget(); ?>
							<?php $form=$this->beginWidget('CActiveForm', array(
									'id' => 'company-form',
									'errorMessageCssClass' => 'help-block',
									'htmlOptions' => array(
										'class' => 'form-horizontal',
										'enctype' => 'multipart/form-data'
									),
							)); ?>
								<div class="form-body">
									<div class="form-group">
										<?php echo $form->label($model, 'company_name',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'company_name',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('company_name')));?>
											<?php echo $form->error($model, 'company_name' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'logo',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->fileField($model, 'logo' ,array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('logo')));?>
											<?php echo $form->error($model, 'logo' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'contact_name',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'contact_name',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('contact_name')));?>
											<?php echo $form->error($model, 'contact_name' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'mobile',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'mobile',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('mobile')));?>
											<?php echo $form->error($model, 'mobile' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'telephone',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'telephone',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('telephone')));?>
											<?php echo $form->error($model, 'telephone' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'email',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'email',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('email')));?>
											<?php echo $form->error($model, 'email' )?>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'homepage',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->textField($model, 'homepage',array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('homepage')));?>
											<?php echo $form->error($model, 'homepage' )?>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn blue">确定</button>
											<a href="<?php echo $this->createUrl('company/index');?>" class="btn default">返回</a>                              
										</div>
									</div>
							<?php $this->endWidget(); ?>
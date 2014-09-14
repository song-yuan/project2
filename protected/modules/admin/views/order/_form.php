							<?php $form=$this->beginWidget('CActiveForm', array(
									'id' => 'order-form',
									'errorMessageCssClass' => 'help-block',
									'htmlOptions' => array(
										'class' => 'form-horizontal',
										'enctype' => 'multipart/form-data'
									),
							)); ?>
								<div class="form-body">
									<div class="form-group">
									<label class="col-md-3 control-label">订单商品</label>
									<div class="col-md-9">
											<div class="portlet-body">
												<table class="table table-striped table-bordered table-advance table-hover">
													<thead>
														<tr>
															<th><i class="fa fa-briefcase"></i>产品名称</th>
															<th class="hidden-xs">类别</th>
															<th>原价</th>
															<th>售价</th>
															<th class="hidden-xs">数量</th>
															<th>总价</th>
														</tr>
													</thead>
													<tbody>
													<?php foreach ($orderProducts as $orderProduct):?>
														<tr>
															<td><a href="#"><?php echo $orderProduct['product_name'];?></a></td>
															<td class="hidden-xs"><?php echo $orderProduct['category_name'];?></td>
															<td><?php echo $orderProduct['origin_price'];?></td>
															<td><?php echo $orderProduct['price'];?></td>
															<td><?php echo $orderProduct['amount'];?></td>
															<td><?php echo $orderProduct['amount']*$orderProduct['price'];?></td>
														</tr>
													<?php endforeach;?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
									<div class="form-group">
										<?php echo $form->label($model, 'order_status',array('class' => 'col-md-3 control-label'));?>
										<div class="col-md-4">
											<?php echo $form->dropDownList($model, 'order_status', array('0' => '待付款' , '1'=>'已付款') ,array('class' => 'form-control','placeholder'=>$model->getAttributeLabel('type_id')));?>
											<?php echo $form->error($model, 'order_status' )?>
										</div>
									</div>
									<div class="form-actions fluid">
										<div class="col-md-offset-3 col-md-9">
											<button type="submit" class="btn blue">确定</button>
											<a href="<?php echo $this->createUrl('siteType/index' , array('companyId' => $model->company_id));?>" class="btn default">返回</a>                              
										</div>
									</div>
							<?php $this->endWidget(); ?>
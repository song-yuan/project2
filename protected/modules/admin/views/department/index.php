<div class="page-content">
	<!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->               
	<div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h4 class="modal-title">Modal title</h4>
				</div>
				<div class="modal-body">
					Widget settings form goes here
				</div>
				<div class="modal-footer">
					<button type="button" class="btn blue">Save changes</button>
					<button type="button" class="btn default" data-dismiss="modal">Close</button>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
	<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
	<!-- BEGIN PAGE HEADER-->
	<?php $this->widget('application.modules.admin.components.widgets.PageHeader', array('head'=>'打印机管理','subhead'=>'打印机列表','breadcrumbs'=>array(array('word'=>'操作间管理','url'=>''),array('word'=>'打印机管理','url'=>''))));?>
	
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-globe"></i>打印机列表</div>
					<div class="actions">
						<a href="<?php echo $this->createUrl('department/create' , array('companyId' => $this->companyId));?>" class="btn blue"><i class="fa fa-pencil"></i> 添加</a>
						<!-- <div class="btn-group">
							<a class="btn green" href="#" data-toggle="dropdown">
							<i class="fa fa-cogs"></i> Tools
							<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="#"><i class="fa fa-ban"></i> 删除</a></li>
							</ul>
						</div> -->
					</div>
				</div>
				<div class="portlet-body" id="table-manage">
					<table class="table table-striped table-bordered table-hover" id="sample_1">
					<?php if($models):?>
						<thead>
							<tr>
								<th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
								<th>名称</th>
								<th>负责人</th>
								<th>打印机</th>
								<th>打印份数</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						
						<?php foreach ($models as $model):?>
							<tr class="odd gradeX">
								<td><input type="checkbox" class="checkboxes" value="<?php echo $model->department_id;?>" name="ids[]" /></td>
								<td ><?php echo $model->name ;?></td>
								<td><?php echo $model->manager;?></td>
								<td><?php echo $model->printer_id;?></td>
								<td><?php echo $model->list_no;?></td>
								<td class="center">
								<a href="<?php echo $this->createUrl('department/update',array('id' => $model->department_id , 'companyId' => $model->company_id));?>">编辑</a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
						<?php else:?>
						<tr><td>还没有添加打印机</td></tr>
						<?php endif;?>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
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
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
			<h3 class="page-title">
				Managed Tables
				<small>managed table samples</small>
			</h3>
			<ul class="page-breadcrumb breadcrumb">
				<li class="btn-group">
					<button type="button" class="btn blue dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-delay="1000" data-close-others="true">
					<span>Actions</span> <i class="fa fa-angle-down"></i>
					</button>
					<ul class="dropdown-menu pull-right" role="menu">
						<li><a href="#">Action</a></li>
						<li><a href="#">Another action</a></li>
						<li><a href="#">Something else here</a></li>
						<li class="divider"></li>
						<li><a href="#">Separated link</a></li>
					</ul>
				</li>
				<li>
					<i class="fa fa-home"></i>
					<a href="index.html">Home</a> 
					<i class="fa fa-angle-right"></i>
				</li>
				<li>
					<a href="#">Data Tables</a>
					<i class="fa fa-angle-right"></i>
				</li>
				<li><a href="#">Managed Tables</a></li>
			</ul>
			<!-- END PAGE TITLE & BREADCRUMB-->
		</div>
	</div>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
	<div class="row">
		<div class="col-md-12">
			<!-- BEGIN EXAMPLE TABLE PORTLET-->
			<div class="portlet box purple">
				<div class="portlet-title">
					<div class="caption"><i class="fa fa-globe"></i>公司列表</div>
					<div class="actions">
						<a href="<?php echo $this->createUrl('company/create');?>" class="btn blue"><i class="fa fa-pencil"></i> Add</a>
						<div class="btn-group">
							<a class="btn green" href="#" data-toggle="dropdown">
							<i class="fa fa-cogs"></i> Tools
							<i class="fa fa-angle-down"></i>
							</a>
							<ul class="dropdown-menu pull-right">
								<li><a href="#"><i class="fa fa-ban"></i> 冻结</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="portlet-body" id="table-manage">
					<table class="table table-striped table-bordered table-hover" id="sample_1">
						<thead>
							<tr>
								<th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
								<th>公司名称</th>
								<th >logo</th>
								<th>联系人</th>
								<th >手机</th>
								<th>电话</th>
								<th >email</th>
								<th >创建时间</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($models as $model):?>
							<tr class="odd gradeX">
								<td><input type="checkbox" class="checkboxes" value="<?php echo $model->company_id;?>" name="companyIds[]" /></td>
								<td><a href="<?php echo $this->createUrl('company/update',array('companyId' => $model->company_id));?>" ><?php echo $model->company_name;?></a></td>
								<td ><img width="100" src="<?php echo $model->logo;?>" /></td>
								<td ><?php echo $model->contact_name;?></td>
								<td ><?php echo $model->mobile;?></td>
								<td ><?php echo $model->telephone;?></td>
								<td ><?php echo $model->email;?></td>
								<td><?php echo date('Y-m-d H:i:s',$model->create_time);?></td>
								<td class="center">
									<a class="btn btn-sm blue"  href="<?php echo $this->createUrl('company/update',array('companyId' => $model->company_id));?>" >编辑</a>
								</td>
							</tr>
						<?php endforeach;?>
						</tbody>
					</table>
				</div>
			</div>
			<!-- END EXAMPLE TABLE PORTLET-->
		</div>
	</div>
	<!-- END PAGE CONTENT-->
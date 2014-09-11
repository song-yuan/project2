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
				<?php if($models):?>
					<div class="tabbable tabbable-custom">
						<ul class="nav nav-tabs">
						<?php $key =0 ;foreach ($models as $model):?>
						<?php $key = $key+1 ;?>
							<li class="<?php if($key == 1) echo 'active' ; ?>"><a href="#tab_1_<?php echo $key;?>" data-toggle="tab"><?php echo $model->name ;?></a></li>
						<?php endforeach;?>	
						</ul>
						<div class="tab-content">
						<?php $key =0 ;foreach ($models as $model):?>
						<?php $key = $key+1 ;?>
							<div class="tab-pane glyphicons-demo <?php if($key == 1) echo 'active' ; ?>" id="tab_1_<?php echo $key;?>">
								<ul class="list-unstyled1">
								<?php if($model->site):?>
								<?php foreach ($model->site as $s):?>
									<li class="<?php if($s->isfree) echo 'btn red';?>"><?php echo $s->serial ;?></li>
								<?php endforeach;?>
								<?php endif;?>
								</ul>
							</div>
						<?php endforeach;?>	
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
	
	
</div>
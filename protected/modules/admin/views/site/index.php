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
	<?php $this->widget('application.modules.admin.components.widgets.PageHeader', array('head'=>'座位管理','subhead'=>'座位列表','breadcrumbs'=>array(array('word'=>'座位管理','url'=>''))));?>
	<!-- END PAGE HEADER-->
	<!-- BEGIN PAGE CONTENT-->
			<div class="row">
			<?php $form=$this->beginWidget('CActiveForm', array(
						'id' => 'site-form',
						'action' => $this->createUrl('site/delete' , array('companyId' => $this->companyId)),
						'errorMessageCssClass' => 'help-block',
						'htmlOptions' => array(
							'class' => 'form-horizontal',
							'enctype' => 'multipart/form-data'
						),
				)); ?>
				<div class="col-md-12">
				<?php if($siteTypes):?>
					<div class="tabbable tabbable-custom">
						<ul class="nav nav-tabs">
						<?php foreach ($siteTypes as $key=>$siteType):?>
							<li class="<?php if($key == $typeId) echo 'active' ; ?>"><a href="#tab_1_<?php echo $key;?>" data-toggle="tab" onclick="location.href='<?php echo $this->createUrl('site/index' , array('typeId'=>$key , 'companyId'=>$this->companyId));?>'"><?php echo $siteType ;?></a></li>
						<?php endforeach;?>	
						</ul>
						<div class="tab-content">
							<div class="portlet box purple">
								<div class="portlet-title">
									<div class="caption"><i class="fa fa-globe"></i>座位列表</div>
									<div class="actions">
										<a href="<?php echo $this->createUrl('site/create' , array('typeId'=>$typeId , 'companyId' => $this->companyId));?>" class="btn blue"><i class="fa fa-pencil"></i> 添加</a>
										<div class="btn-group">
											<button type="submit"  class="btn red" ><i class="fa fa-ban"></i> 删除</button>
										</div>
									</div>
								</div>
								<div class="portlet-body" id="table-manage">
									<table class="table table-striped table-bordered table-hover" id="sample_1">
										<thead>
											<tr>
												<th class="table-checkbox"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
												<th>座位号</th>
												<th>类型</th>
												<th>等级</th>
												<th>&nbsp;</th>
											</tr>
										</thead>
										<tbody>
										<?php if($models):?>
										<?php foreach ($models as $model):?>
											<tr class="odd gradeX">
												<td><input type="checkbox" class="checkboxes"  value="<?php echo $model->site_id;?>" name="ids[]" /></td>
												<td ><?php echo $model->serial ;?></td>
												<td ><?php echo $model->siteType->name ;?></td>
												<td><?php echo $model->site_level;?></td>
												<td class="center">
												<a href="<?php echo $this->createUrl('site/update',array('id' => $model->site_id , 'companyId' => $model->company_id));?>">编辑</a>
												</td>
											</tr>
										<?php endforeach;?>
										<?php endif;?>
										</tbody>
									</table>
										<?php if($pages->getItemCount()):?>
										<div class="row">
											<div class="col-md-5 col-sm-12">
												<div class="dataTables_info">
													共 <?php echo $pages->getPageCount();?> 页  , <?php echo $pages->getItemCount();?> 条数据 , 当前是第 <?php echo $pages->getCurrentPage()+1;?> 页
												</div>
											</div>
											<div class="col-md-7 col-sm-12">
												<div class="dataTables_paginate paging_bootstrap">
												<?php $this->widget('CLinkPager', array(
													'pages' => $pages,
													'header'=>'',
													'firstPageLabel' => '<<',
													'lastPageLabel' => '>>',
													'firstPageCssClass' => '',
													'lastPageCssClass' => '',
													'maxButtonCount' => 8,
													'nextPageCssClass' => '',
													'previousPageCssClass' => '',
													'prevPageLabel' => '<',
													'nextPageLabel' => '>',
													'selectedPageCssClass' => 'active',
													'internalPageCssClass' => '',
													'hiddenPageCssClass' => 'disabled',
													'htmlOptions'=>array('class'=>'pagination pull-right')
												));
												?>
												</div>
											</div>
										</div>
										<?php endif;?>					
									
								</div>
							</div>
							<!-- END EXAMPLE TABLE PORTLET-->
												
						</div>
					</div>
				<?php endif;?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	
</div>
	<script type="text/javascript">
	$(document).ready(function(){
		$('#site-form').submit(function(){
			if(!$('.checkboxes:checked').length){
				alert('请选择要删除的项');
				return false;
			}
			return true;
		});
	});
	</script>
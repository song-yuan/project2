			<div class="row">
				<div class="col-md-12">
					<!-- BEGIN PAGE TITLE & BREADCRUMB-->			
					<h3 class="page-title">
						<?php echo $head;?>
						<?php if($subhead):?>
						<small><?php echo $subhead;?></small>
						<?php endif;?>
					</h3>
					<ul class="page-breadcrumb breadcrumb">
						<?php if($back):?>
						<li class="btn-group">
							<div class="actions">
								<?php echo CHtml::link('<i class="m-icon-swapleft"></i> '.$back['word'],$back['url'],array('class'=>'btn blue'));?>
							</div>
						</li>
						<?php endif;?>
						<li>
							<i class="fa fa-home"></i>
							<a href="<?php echo Yii::app()->createUrl('admin/default',array('companyId'=>Yii::app()->controller->companyId));?>">首页</a> 
							<i class="fa fa-angle-right"></i>
						</li>
						<?php for($i = 0,$count = count($breadcrumbs);$i < $count;$i++):?>
						<li>
							<?php echo CHtml::link($breadcrumbs[$i]['word'],$breadcrumbs[$i]['url']);?>
							<?php if($i < $count-1):?>
							<i class="fa fa-angle-right"></i>
							<?php endif;?>
						</li>
						<?php endfor;?>
					</ul>
					<!-- END PAGE TITLE & BREADCRUMB-->
				</div>
			</div>
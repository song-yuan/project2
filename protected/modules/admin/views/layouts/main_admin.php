<!DOCTYPE html>
<html lang="en>">
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>后台管理系统</title>
	<meta name="MobileOptimized" content="320">
	<!-- BEGIN GLOBAL MANDATORY STYLES -->
	<?php Yii::app()->clientScript->registerCssFile('plugins/font-awesome/css/font-awesome.min.css');?>
	<?php Yii::app()->clientScript->registerCssFile('plugins/bootstrap/css/bootstrap.min.css');?>
	<?php Yii::app()->clientScript->registerCssFile('plugins/uniform/css/uniform.default.css');?>
	<!-- END GLOBAL MANDATORY STYLES -->
	<!-- BEGIN PAGE LEVEL STYLES --> 
	<?php Yii::app()->clientScript->registerCssFile('plugins/select2/select2_metro.css');?>
	<!-- END PAGE LEVEL SCRIPTS -->
	<!-- BEGIN THEME STYLES --> 
	<?php Yii::app()->clientScript->registerCssFile('css/style-metronic.css');?>
	<?php Yii::app()->clientScript->registerCssFile('css/style.css');?>
	<?php Yii::app()->clientScript->registerCssFile('css/style-responsive.css');?>
	<?php Yii::app()->clientScript->registerCssFile('css/themes/default.css');?>
	<?php Yii::app()->clientScript->registerCssFile('css/custom.css');?>
	<!-- END THEME STYLES -->
	<link rel="shortcut icon" href="favicon.ico" />
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-header-fixed">
	<?php $this->beginContent('/layouts/header');?>
	<?php $this->endContent();?>
	<!-- BEGIN CONTAINER -->
	<div class="page-container">
	<?php $this->beginContent('/layouts/sidebar');?>
	<?php $this->endContent();?>
	<!-- BEGIN PAGE -->
		<?php echo $content;?>
	<!-- END PAGE -->
	</div>
	<!-- END CONTAINER -->
	<!-- BEGIN FOOTER -->
	<?php $this->beginContent('/layouts/footer');?>
	<?php $this->endContent();?>
	<!-- END FOOTER -->
	<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
	<!-- BEGIN CORE PLUGINS -->   
	<!--[if lt IE 9]>
	<script src="assets/plugins/respond.min.js"></script>
	<script src="assets/plugins/excanvas.min.js"></script> 
	<![endif]-->
	<?php Yii::app()->clientScript->registerCoreScript('jquery');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/jquery-migrate-1.2.1.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/bootstrap/js/bootstrap.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/bootstrap-hover-dropdown/twitter-bootstrap-hover-dropdown.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/jquery-slimscroll/jquery.slimscroll.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/jquery.blockui.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/jquery.cookie.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/uniform/jquery.uniform.min.js');?>
	<!-- END CORE PLUGINS -->
	<!-- BEGIN PAGE LEVEL PLUGINS -->
	<?php Yii::app()->clientScript->registerScriptFile('plugins/select2/select2.min.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/data-tables/jquery.dataTables.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('plugins/data-tables/DT_bootstrap.js');?>
	<!-- END PAGE LEVEL PLUGINS -->
	<!-- BEGIN PAGE LEVEL SCRIPTS -->
	<?php Yii::app()->clientScript->registerScriptFile('scripts/app.js');?>
	<?php Yii::app()->clientScript->registerScriptFile('scripts/table-managed.js');?>
	<script>
		jQuery(document).ready(function() {
		   App.init();
		   TableManaged.init();
		});
	</script>
</body>
<!-- END BODY -->
</html>

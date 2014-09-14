<?php


/* @var $this \yii\web\View */
/* @var $content string */
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo  CHtml::encode($this->pageTitle); ?></title>
    <link rel="stylesheet" type="text/css" href="css/waiter/waiter.css"/>
    <script type="text/javascript" src="plugins/jquery-1.10.2.min.js"></script> 
    
</head>
<body>
    <div class="page">
    <?php echo $content ?>
    </div>
</body>
</html>

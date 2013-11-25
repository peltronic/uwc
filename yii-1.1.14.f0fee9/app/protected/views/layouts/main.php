<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <script src="/js/jquery-1.10.2.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
        <div class="floatLeft">
		    <div id="logo">Peter Gorgone: Experienced Website Developer</div>
		    <div id="sub-logo">Custom Programming for Backend and Frontend Technologies</div>
        </div>
        <div id="box-contact" class="floatRight">
            <div id="contact-email">
                <script type="text/javascript"> var name = "peter"; var domain = "@peltronic.com"; var txtstr = name + domain; document.write('Email: '+txtstr+''); </script>
            </div>
            <div id="contact-phone">
                <script type="text/javascript"> var name = "(424) "; var domain1 = "241" ; var domain2 = "9327"; var txtstr = name + domain1 + '-' + domain2; document.write('Phone: '+txtstr+''); </script>
            </div>
        </div>
        <div class="clearFloat"></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'Home', 'url'=>array('/home')),
				array('label'=>'Resume', 'url'=>array('/resume')),
				array('label'=>'Portfolio', 'url'=>array('/project'))
				//array('label'=>'Resume', 'url'=>array('/resume', 'view'=>'about')),
				//array('label'=>'Contact', 'url'=>array('/site/contact'))
			),
		)); ?>
	</div><!-- mainmenu -->

	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
            'homeLink'=>CHtml::link('PSG Consulting', Yii::app()->homeUrl), 
		)); ?><!-- breadcrumbs -->
	<?php endif?>

	<?php echo $content; ?>

	<div class="clear"></div>

	<div id="footer">
		Copyright &copy; <?php echo date('Y'); ?> by PSG Consulting.<br/>
		All Rights Reserved.<br/>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>

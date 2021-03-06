<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

  <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/themes/redmond/jquery-ui.min.css">

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

    <script src="/js/jquery-1.10.2.min.js"></script>
    <script src="/js/jquery-ui-1.10.3.custom.min.js"></script>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>

<?php if ( !empty($this->pageDescription) ) {?>
    <meta name="description" content="<?php echo $this->pageDescription; ?>">
<?php } else { ?>
    <meta name="description" content="Expert Web Developer available for freelance projects. Over 5 years experience programming in PHP, MySQL, Javascript, CSS, and more.">
<?php } ?>
    
<script>
  $(function() {
    var icons = {
      header: "ui-icon-circle-arrow-e",
      activeHeader: "ui-icon-circle-arrow-s"
    };
    $( ".accordion" ).accordion({
      collapsible: true,
      active: 'none',
      heightStyle: "content",
      icons: icons
    });
    $( "#toggle" ).button().click(function() {
      if ( $( ".accordion" ).accordion( "option", "icons" ) ) {
        $( ".accordion" ).accordion( "option", "icons", null );
      } else {
        $( ".accordion" ).accordion( "option", "icons", icons );
      }
    });

$( ".accordion" ).accordion( "option", "active", 0 ); // open first tab

  });
</script>
</head>

<body>

<div class="container" id="page">

	<div id="header">
        <div class="floatLeft">
		    <div id="logo">Peter Gorgone: Expert Web and Application Developer</div>
		    <div id="sub-logo">Rapid, Professional Custom Development for Small Business and Startups</div>
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
				//array('label'=>'Resume', 'url'=>array('/resume')),
				array('label'=>'Portfolio', 'url'=>array('/portfolio'))
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-46190050-1', 'peterg-webdeveloper.com');
  ga('send', 'pageview');
</script>

</body>
</html>

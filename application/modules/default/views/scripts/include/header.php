<?php Bc_Output::prepareHtml();?>
<!DOCTYPE html>
<html>
  <head>
    <title><?php echo Bc_Config::appConfig()->app_name;?></title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="Bigcapital.co" />
    <meta name="author" content="sam@Bigcapital.co" />

    <base href='http://<?php echo $_SERVER["HTTP_HOST"];?>/' />
    
    <link href='css/jquery-ui.min.css' rel='stylesheet' />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/calendar.min.css" rel="stylesheet">
	<link href="css/bc.css" rel="stylesheet">
	<link href="assets/ueditor/themes/default/css/umeditor.css" rel="stylesheet" />
	<link href="css/qy.css" rel="stylesheet">
	<?php
	if ($this->user['Role']) {
	?>
	<link href="css/<?php echo $this->user['Role'];?>.css" rel="stylesheet" />
	<?php
	}
	?>
	
    <link rel="shortcut icon" href="favicon.ico">

    <script type='text/javascript'>
	var BASE_HREF = 'http://<?php echo $_SERVER['HTTP_HOST'];?>/';
	var CONTROLLER = '<?php echo $this->cName;?>';
	var MODULE = '<?php echo $this->url(array(
		'controller' => 'index',
		'action' => 'index',
		'module' => $this->MODULE
		));?>';
	var DEBUG = <?php echo Bc_Config::appConfig()->debug ? 'true' : 'false';?>;
    </script>
    
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
  </head>

  <body>
    <a class="sr-only" href="#content">Skip to main content</a>
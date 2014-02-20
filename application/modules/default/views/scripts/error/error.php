<?php Bc_Output::prepareHtml();?>
<!DOCTYPE html>
<html>
  <head>
    <title>出错了！</title>
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
	<link href="css/weshop.css" rel="stylesheet">
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
<div class='container'>
    	<div class='row'>
    		<div class='alert alert-danger col-sm-8 col-sm-offset-2'>
    			<h2>出错了</h2>
    			<h3><?php echo $this->message ?></h3>
			
			  <?php if (isset($this->exception)): ?>
			
			  <h3>错误情况</h3>
			  <p>
			      <b>信息:</b> <?php echo $this->exception->getMessage() ?>
			  </p>
			
			  <?php if (APPLICATION_ENV!='production') { ?>
			  <h3>Stack trace:</h3>
			  <pre><?php echo $this->exception->getTraceAsString() ?>
			  </pre>
			
			  <h3>Request Parameters:</h3>
			  <pre><?php echo var_export($this->request->getParams(), true) ?>
			  </pre>
			  <?php } ?>
			  <?php endif ?>    			
    		</div>
    	</div>
    </div>
</body>
</html>
<?php Bc_Output::doOutput();?>
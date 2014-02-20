<?php include dirname(__FILE__).'/../include/header.php'; ?>
<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <a href="<?php echo $this->url(array(
      	'controller' => 'welcome',
      	'action' => 'index',
      	'module' => $this->MODULE
      ));?>" class="navbar-brand">WeShop</a>
    </div>
  </div>
</header>

<div class="container">
	<div class='row'>
		<div class='col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3' id='main_content'>
		
<?php if ($this->error) { ?>		
<div class='alert alert-danger'><?php echo $this->error;?></div>
<?php } ?>

<form role="form" action='<?php echo $this->url(array(
	'action' => 'do'
));?>' method='post'>
  <div class="form-group">
    <label for="exampleInputEmail1">用户名</label>
    <input type="text" class="form-control" id="username" name="username" placeholder="输入用户名以登录Weshop">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">密码</label>
    <input type="password" class="form-control" id="password" name="password" placeholder="输入密码以登录Weshop">
  </div>
  <button type="submit" class="btn btn-weshop">登录</button>
</form>

		
		
		</div>
	</div>
</div>
<?php include dirname(__FILE__).'/../include/footer.php'; ?>
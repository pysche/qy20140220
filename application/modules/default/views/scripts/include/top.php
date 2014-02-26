<header class="navbar navbar-inverse navbar-fixed-top bs-docs-nav" role="banner">
  <div class="container">
    <div class="navbar-header">
      <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a href="<?php echo $this->url(array(
      	'controller' => 'welcome',
      	'action' => 'index',
      	'module' => $this->MODULE
      ));?>" class="navbar-brand"><?php echo Bc_Config::appConfig()->app_name;?></a>
    </div>
    <nav class="collapse navbar-collapse bs-navbar-collapse" role="navigation">
      <ul class="nav navbar-nav" data-role='top_menu'>
      	<?php foreach ($this->config->weshop->top_menu->toArray() as $key => $menu) { ?>
        <li data-key='<?php echo $key;?>' data-role="menu_item">
          <a href="javascript: void(0);" data-toggle="dropdown"><?php echo $menu['name'];?></a>
          <?php
          if (count($menu['sub_menu'])>0) {
          ?>
          <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
          <?php
            foreach ($menu['sub_menu'] as $smenu) {
            ?>
            <li><a data-role='smenu' href='/<?php echo $smenu['link'];?>' data-format='html' data-transport='ajax'><?php echo $smenu['title'];?></a></li>
            <?php
            }
          ?>
          </ul>
          <?php
          }
          ?>
        </li>
        <?php } ?>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li><a href='#'>当前用户：<?php echo $this->user['Realname'];?> (<?php echo $this->CONFIG['auth']['role'][$this->user['Role']];?>)</a></li>
        <li>
          <a href="<?php echo $this->url(array(
          	'action' => 'modifypassword',
          	'controller' => 'self',
          	'module' => $this->MODULE
          ));?>" data-target='main_content' data-transport='ajax'>修改密码</a>
        </li>
        <li>
          <a href="<?php echo $this->url(array(
          	'action' => 'logout',
          	'controller' => 'login',
          	'module' => $this->MODULE
          ));?>">退出</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

	<div id='ajax_loading' class='alert alert-info'>
	  正在加载，请稍候 ...
	</div>
	<div id='msg_success' class='alert alert-success'>
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <div id='msg_success_content'></div>
	</div>
	<div id='msg_error' class='alert alert-danger'>
	  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
	  <div id='msg_error_content'></div>
	</div>		
<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => 'welcome',
	  	'action' => 'dashboard',
	  	'module' => $this->MODULE
	  ));?>" data-transport="ajax">首页</a></li>
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => $this->cName,
	  	'module' => $this->MODULE,
	  	'action' => 'index'
	  ));?>" data-transport="ajax">用户列表</a></li>
	  <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>用户</li>
	</ol>
	
	<form class="form-horizontal" role="form" method='post' action='<?php echo $this->url(array(
		'controller' => $this->cName,
		'action' => $this->vo->id ? 'update' : 'insert',
		'module' => $this->MODULE
	));?>' data-trasport='ajax' data-redirect='<?php echo $this->url(array(
		'controller' => $this->cName,
		'action' => 'index',
		'module' => $this->MODULE
	));?>' target='form_target'>
	  <div class="form-group">
	    <label for="Username" class="col-sm-2 control-label">用户名</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Username" name="Username" placeholder="请填写用户名" required value='<?php echo $this->vo->Username;?>' />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Password" class="col-sm-2 control-label">密码</label>
	    <div class="col-sm-10">
	      <input type="password" class="form-control" id="Password" name="Password" placeholder="<?php if ($this->vo->id) { ?>如不修改密码，请留空<?php } else { ?>请填写密码<?php } ?>" <?php if (!$this->vo->id) { ?>required<?php } ?> />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Realname" class="col-sm-2 control-label">姓名</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Realname" name="Realname" placeholder="请填写姓名" required value='<?php echo $this->vo->Realname;?>' />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Email" class="col-sm-2 control-label">Email</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Email" name="Email" placeholder="请填写Email" required value='<?php echo $this->vo->Email;?>' />
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Role" class="col-sm-2 control-label">角色</label>
	    <div class="col-sm-10">
	      <?php
	      echo $this->formSelect('Role', $this->vo->Role, array(
	      	'class' => 'form-control'
	      	), $this->config->auth->role->toArray());
	      ?>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Status" class="col-sm-2 control-label">状态</label>
	    <div class="col-sm-10">
	    	<?php echo $this->formRadio('Status', (int)$this->vo->Status, array(
	    		
	    	), array(
	    		1 => ' 启用', 
	    		0 => ' 禁用'
	    	), ' ');?>
	    </div>
	  </div>
	  <div class="form-group">
	    <label for="Remark" class="col-sm-2 control-label">备注</label>
	    <div class="col-sm-10">
	      <textarea name='Remark' id='Remark' class='form-control' rows='5'><?php echo $this->vo->Remark;?></textarea>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary">提交</button>
	      <a class='btn btn-success' href='<?php echo $this->url(array(
	      	'action' => 'index'
	      ), null, true);?>' data-transport='ajax'>返回列表</a>
	    </div>
	  </div>
	</form>
</div>
<?php Bc_Output::doOutput();?>
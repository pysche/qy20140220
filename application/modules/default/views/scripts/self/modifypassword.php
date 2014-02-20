<form class="form-horizontal" role="form" action='<?php echo $this->url(array(
	'action' => 'domodifypassword',
	'controller' => 'self',
	'module' => $this->MODULE
));?>' target='form_target' method='post'>
  <div class="form-group">
    <label for="new_password" class="col-sm-2 control-label">新密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name='new_password' id="new_password" placeholder="新密码" required>
    </div>
  </div>
  <div class="form-group">
    <label for="confirm_password" class="col-sm-2 control-label">确认密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name='confirm_password' id="confirm_password" placeholder="确认密码" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default">确认修改密码</button>
    </div>
  </div>
</form>
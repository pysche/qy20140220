<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => 'welcome',
	  	'module' => $this->MODULE
	  ), null, true);?>" data-transport="ajax">首页</a></li>
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => $this->cName,
	  	'module' => $this->MODULE,
	  	'action' => 'index'
	  ), null, true);?>" data-transport="ajax"><?php echo $this->MName;?></a></li>
	  <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>系统公告</li>
	</ol>
	
	<form class="form-horizontal" role="form" method='post' action='<?php echo $this->url(array(
		'controller' => $this->cName,
		'action' => $this->vo->id ? 'update' : 'insert',
		'module' => $this->MODULE
	), null, true);?>' data-trasport='ajax' data-redirect='<?php echo $this->url(array(
		'controller' => $this->cName,
		'action' => 'index',
		'module' => $this->MODULE
	), null, true);?>' target='form_target'>

	  <div class="form-group">
	    <label for="Title" class="col-sm-2 control-label">公告标题</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Title" name="Title" placeholder="请填写公告标题" required value='<?php echo $this->vo->Title;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Content" class="col-sm-2 control-label">公告详情</label>
	    <div class="col-sm-10">
	      <textarea name='Content' id='Content' rows='16' class='form-control' data-role="kindeditor"><?php echo $this->vo->Content;?></textarea>
	    </div>
	  </div>


	  <div class="form-group">
	    <label for="Status" class="col-sm-2 control-label">发布状态</label>
	    <div class="col-sm-10">
	    	<?php echo $this->formRadio('Status', (int)$this->vo->Status, array(
	    		
	    	), array(
	    		1 => ' 启用', 
	    		0 => ' 禁用'
	    	), ' ');?>
	    </div>
	  </div>
	  <div class="form-group">
	    <div class="col-sm-offset-2 col-sm-10">
	      <button type="submit" class="btn btn-primary">提交</button>

	      <button type="reset" class="btn btn-warning">重新填写</button>

	      <a href="<?php echo $this->url(array(
	      	'module' => $this->MODULE,
	      	'controller' => $this->cName
	      ), null, true);?>" data-transport='ajax' data-format='html' class="btn btn-success">返回列表</a>

	      <input type='hidden' name='id' value='<?php echo (int)$this->vo->id;?>' />
	    </div>
	  </div>
	</form>
</div>
<?php Bc_Output::doOutput();?>
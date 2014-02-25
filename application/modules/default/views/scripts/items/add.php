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
	  <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>交易项目</li>
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
	    <label for="Code" class="col-sm-2 control-label">项目代码</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" id="Code" name="Code" placeholder="请填写项目代码" required value='<?php echo $this->vo->Code;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Name" class="col-sm-2 control-label">项目名称</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写项目名称" required value='<?php echo $this->vo->Name;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Category" class="col-sm-2 control-label">项目类型</label>
	    <div class="col-sm-4">
	      <select class='form-control'>
	      <?php
	      foreach ($this->config->item_categories->toArray() as $k=>$v) {
	      ?>
	      <option value='<?php echo $k;?>'><?php echo $v;?></option>
	      <?php
	      }
	      ?>
	      </select>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Start" class="col-sm-2 control-label">交易开始时间</label>
	    <div class="col-sm-4">
	      <input type='text' class='form-control' name='Start' id='Start' value='<?php echo $this->vo->Start;?>' data-role='datepicker' readonly='readonly' required />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="End" class="col-sm-2 control-label">交易结束时间</label>
	    <div class="col-sm-4">
	      <input type='text' class='form-control' name='End' id='End' value='<?php echo $this->vo->End;?>' data-role='datepicker' readonly='readonly' required />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Memo" class="col-sm-2 control-label">项目描述</label>
	    <div class="col-sm-4">
	      <textarea name='Memo' id='Memo' rows='4' cols='50'><?php echo $this->vo->Memo;?></textarea>
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
	    </div>
	  </div>
	</form>
</div>
<?php Bc_Output::doOutput();?>
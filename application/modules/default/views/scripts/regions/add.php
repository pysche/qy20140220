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
    <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>地区</li>
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
      <label for="Name" class="col-sm-2 control-label">地区名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写地区名称" required value='<?php echo $this->vo->Name;?>' /> 
      </div>
    </div>
    
    <div class="form-group">
      <label for="ParentId" class="col-sm-2 control-label">上级地区</label>
      <div class="col-sm-4">
	      <?php
	      echo $this->formSelect('ParentId', (int)$this->vo->ParentId ? $this->vo->ParentId : $this->ParentId, array(
	      	'class' => 'form-control'
	      	), $this->levels);
	      ?>
      </div>
    </div>
    
    <div class="form-group">
      <label for="Sort" class="col-sm-2 control-label">排序值</label>
      <div class="col-sm-4">
        <input type="text" class="form-control " id="Sort" name="Sort" placeholder="排序值，数字小者在前" value='<?php echo $this->vo->Sort;?>' />
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
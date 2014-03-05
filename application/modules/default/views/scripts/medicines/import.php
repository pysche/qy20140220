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
    <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>药品</li>
  </ol>
  
  <form class="form-horizontal" role="form" method='post' action='<?php echo $this->url(array(
    'controller' => $this->cName,
    'action' => 'doimport',
    'module' => $this->MODULE
  ), null, true);?>' data-redirect='<?php echo $this->url(array(
    'controller' => $this->cName,
    'action' => 'import',
    'module' => $this->MODULE
  ), null, true);?>' target='sssform_target' enctype='multipart/form-data'>

    <div class="form-group">
      <label for="File" class="col-sm-2 control-label">药品数据文件</label>
      <div class="col-sm-10">
        <input type="file" class="form-control" id="File" name="File" />
      </div>
    </div>

    <div class="form-group">
      <label for="ProdName" class="col-sm-2 control-label">备注</label>
      <div class="col-sm-10">
        <div class='alert alert-danger'>
          <p>请将数据文件按照如下样板整理好，并保存为CSV文件。</p>
          <p><a href='#'>下载样板文件</a></p>
        </div>
      </div>
    </div>


    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-primary">提交</button>

        <button type="reset" class="btn btn-warning">重新填写</button>
        <input type='hidden' name='id' value='<?php echo (int)$this->vo->id;?>' />

        <a href="<?php echo $this->url(array(
          'module' => $this->MODULE,
          'controller' => $this->cName
        ), null, true);?>" data-transport='ajax' data-format='html' class="btn btn-success">返回列表</a>
      </div>
    </div>
  </form>
</div>
<?php Bc_Output::doOutput();?>
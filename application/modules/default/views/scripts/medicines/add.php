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
    'action' => $this->vo->id ? 'update' : 'insert',
    'module' => $this->MODULE
  ), null, true);?>' data-trasport='ajax' data-redirect='<?php echo $this->url(array(
    'controller' => $this->cName,
    'action' => 'index',
    'module' => $this->MODULE
  ), null, true);?>' target='form_target'>

    <div class="form-group">
      <label for="Name" class="col-sm-2 control-label">名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写药品名称" required value='<?php echo $this->vo->Name;?>' /> 
      </div>
    </div>

    <div class="form-group">
      <label for="ProdName" class="col-sm-2 control-label">通用名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="ProdName" name="ProdName" placeholder="请填写通用名称" required value='<?php echo $this->vo->ProdName;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="DosageForm" class="col-sm-2 control-label">规格型号</label>
      <div class="col-sm-10">
      	<input type="text" class="form-control" id="DosageForm" name="DosageForm" placeholder="请填写规格型号" required value='<?php echo $this->vo->DosageForm;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="OriginPlace" class="col-sm-2 control-label">产地</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="OriginPlace" name="OriginPlace" placeholder="请填写药品产地" value='<?php echo $this->vo->OriginPlace;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Usage" class="col-sm-2 control-label">用途</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="Usage" name="Usage" placeholder="请填写用途" value='<?php echo $this->vo->Usage;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="ImportPrice" class="col-sm-2 control-label">单价</label>
      <div class="col-sm-4">
        <input type="text" class="form-control " id="ImportPrice" name="ImportPrice" placeholder="" value='<?php echo $this->vo->ImportPrice;?>' />
      </div>
      <div class="col-md-1">
      元
      </div>
    </div>

    <div class="form-group">
      <label for="Unit" class="col-sm-2 control-label">计量单位</label>
      <div class="col-sm-4">
        <input type="text" class="form-control " id="Unit" name="Unit" placeholder="" value='<?php echo $this->vo->Unit;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Settings" class="col-sm-2 control-label">其他设置</label>
      <div class="col-sm-10">
        <?php echo $this->formCheckbox('IsBasic', 1, array(
        	'checked' => (int)$this->vo->IsBasic==1 ? true : false
        )); ?> 是否为基本药物
        
        <?php echo $this->formCheckbox('IsLevel2Basic', 1, array(
        	'checked' => (int)$this->vo->IsLevel2Basic ? true : false
        )); ?> 是否为二级医院专用基本药物
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
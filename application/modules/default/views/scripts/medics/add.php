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
    <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>商品</li>
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
      <label for="Code" class="col-sm-2 control-label">商品编号</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="Code" name="Code" placeholder="请填写商品编号" required value='<?php echo $this->vo->Code;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Name" class="col-sm-2 control-label">商品名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写商品名称" required value='<?php echo $this->vo->Name;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="NormalName" class="col-sm-2 control-label">通用名称</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="NormalName" name="NormalName" placeholder="请填写通用名称" required value='<?php echo $this->vo->NormalName;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="RegCode" class="col-sm-2 control-label">注册证号</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="RegCode" name="RegCode" placeholder="" value='<?php echo $this->vo->RegCode;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="RegExpire" class="col-sm-2 control-label">注册有效期</label>
      <div class="col-sm-4">
        <input type='text' class='form-control' data-role='datepicker' value='<?php echo $this->vo->RegExpire;?>' readonly='readonly' />
      </div>
    </div>

    <div class="form-group">
      <label for="Ggxh" class="col-sm-2 control-label">规格型号</label>
      <div class="col-sm-10">
        <textarea name='Ggxh' class='form-control' id='Ggxh' rows='4' cols='50'><?php echo $this->vo->Ggxh;?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="Brand" class="col-sm-2 control-label">品牌</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="Brand" name="Brand" placeholder="" value='<?php echo $this->vo->Brand;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="ProduceCompany" class="col-sm-2 control-label">生产企业</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="ProduceCompany" name="ProduceCompany" placeholder="" value='<?php echo $this->vo->ProduceCompany;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="SaleCompany" class="col-sm-2 control-label">经销企业</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="SaleCompany" name="SaleCompany" placeholder="" value='<?php echo $this->vo->SaleCompany;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Price" class="col-sm-2 control-label">单价</label>
      <div class="col-sm-4">
        <input type="text" class="form-control " id="Price" name="Price" placeholder="" value='<?php echo $this->vo->Price;?>' />
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
      <label for="Jydw" class="col-sm-2 control-label">交易单位</label>
      <div class="col-sm-4">
        <textarea name='Jydw' class='form-control' id='Jydw' rows='4' cols='50'><?php echo $this->vo->Jydw;?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="Xnzc" class="col-sm-2 control-label">性能组成</label>
      <div class="col-sm-10">
        <textarea name='Xnzc' class='form-control' id='Xnzc' rows='4' cols='50'><?php echo $this->vo->Xnzc;?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="Bzgg" class="col-sm-2 control-label">包装规格</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="Bzgg" name="Bzgg" placeholder="" value='<?php echo $this->vo->Bzgg;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Bzcl" class="col-sm-2 control-label">包装材料</label>
      <div class="col-sm-10">
        <input type="text" class="form-control " id="Bzcl" name="Bzcl" placeholder="" value='<?php echo $this->vo->Bzcl;?>' />
      </div>
    </div>

    <div class="form-group">
      <label for="Memo" class="col-sm-2 control-label">备注</label>
      <div class="col-sm-10">
        <textarea name='Memo' class='form-control' id='Memo' rows='4' cols='50'><?php echo $this->vo->Memo;?></textarea>
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

<div class="modal fade" data-role='modal' id='<?php echo $this->cName;?>_<?php echo $this->vo->id ? 'edit' : 'add';?>'>
  <div class="modal-dialog modal-fix">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title"><?php echo $this->vo->id ? '修改' : '新增';?>平台机构</h4>
      </div>
      <div class="modal-body">
              
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
            <label for="Name" class="col-sm-2 control-label">机构名称</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写机构名称" required value='<?php echo $this->vo->Name;?>' />
            </div>
            <div class="col-sm-4">
              <a href='<?php echo $this->url(array(
                'module' => $this->MODULE,
                'controller' => 'welcome'
              ), null, true);?>' class='btn btn-small btn-info' data-toggle='modal' data-target=''>选择机构</a>
            </div>
          </div>

          <div class="form-group">
            <label for="Contactor" class="col-sm-2 control-label">联系人</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="Contactor" name="Contactor" placeholder="请填写联系人" value='<?php echo $this->vo->ContactorTel;?>' />
            </div>
          </div>

          <div class="form-group">
            <label for="ContactorTel" class="col-sm-2 control-label">联系电话</label>
            <div class="col-sm-8">
              <input type="text" class="form-control" id="ContactorTel" name="ContactorTel" placeholder="请填写联系电话" value='<?php echo $this->vo->ContactorTel;?>' />
            </div>
          </div>

          <div class="form-group">
            <label for="Address" class="col-sm-2 control-label">地址</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="Address" name="Address" placeholder="请填写地址" value='<?php echo $this->vo->Address;?>' />
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
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-primary">保存</button>
      </div>
    </div>
  </div>
</div>
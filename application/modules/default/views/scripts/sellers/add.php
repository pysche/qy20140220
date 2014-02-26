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
	  <li class="active"><?php echo $this->vo->id ? '修改' : '新建';?>机构</li>
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
	    <label for="Code" class="col-sm-2 control-label">机构代码</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Code" name="Code" placeholder="请填写机构代码" required value='<?php echo $this->vo->Code;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Name" class="col-sm-2 control-label">机构名称</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Name" name="Name" placeholder="请填写机构名称" required value='<?php echo $this->vo->Name;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="ShortName" class="col-sm-2 control-label">机构简称</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="ShortName" name="ShortName" placeholder="请填写机构简称" required value='<?php echo $this->vo->ShortName;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="PinYin" class="col-sm-2 control-label">拼音简码</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="PinYin" name="PinYin" placeholder="" required value='<?php echo $this->vo->PinYin;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>拼音简码</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="WuBi" class="col-sm-2 control-label">五笔简码</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="WuBi" name="WuBi" placeholder="" required value='<?php echo $this->vo->WuBi;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>五笔简码</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Address" class="col-sm-2 control-label">地址</label>
	    <div class="col-sm-10">
	      <input type="text" class="form-control" id="Address" name="Address" placeholder="请填写机构地址" required value='<?php echo $this->vo->Address;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Zipcode" class="col-sm-2 control-label">邮政编码</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Zipcode" name="Zipcode" placeholder="请填写邮政编码" required value='<?php echo $this->vo->Zipcode;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Tel" class="col-sm-2 control-label">电话</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Tel" name="Tel" placeholder="请填写电话" required value='<?php echo $this->vo->Tel;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Fax" class="col-sm-2 control-label">传真</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Fax" name="Fax" placeholder="请填写传真" required value='<?php echo $this->vo->Tel;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Website" class="col-sm-2 control-label">网址</label>
	    <div class="col-sm-8">
	      <input type="text" class="form-control " id="Website" name="Website" placeholder="请填写网址" required value='<?php echo $this->vo->Website;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Country" class="col-sm-2 control-label">国家</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Country" name="Country" placeholder="" required value='<?php echo $this->vo->Country;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>选择国家</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Province" class="col-sm-2 control-label">省序号</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Province" name="Province" placeholder="" required value='<?php echo $this->vo->Province;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>选择省级</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="City" class="col-sm-2 control-label">市序号</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="City" name="City" placeholder="" required value='<?php echo $this->vo->City;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>选择市级</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="County" class="col-sm-2 control-label">县序号</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="County" name="County" placeholder="" required value='<?php echo $this->vo->County;?>' />
	    </div>
	    <div class='col-sm-2'>
	    	<button type='button' class='btn btn-small btn-info'>选择县级</button>
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Contactor" class="col-sm-2 control-label">联系人</label>
	    <div class="col-sm-2">
	      <input type="text" class="form-control " id="Contactor" name="Contactor" placeholder="" required value='<?php echo $this->vo->Contactor;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="ContactorTel" class="col-sm-2 control-label">联系电话</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control " id="ContactorTel" name="ContactorTel" placeholder="" required value='<?php echo $this->vo->ContactorTel;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Email" class="col-sm-2 control-label">电子邮件</label>
	    <div class="col-sm-4">
	      <input type="text" class="form-control" id="Email" name="Email" placeholder="请填写Email" required value='<?php echo $this->vo->Email;?>' />
	    </div>
	  </div>

	  <div class="form-group">
	    <label for="Memo" class="col-sm-2 control-label">机构描述</label>
	    <div class="col-sm-4">
	      <textarea name='Memo' id='Memo' rows='4' cols='50'><?php echo $this->vo->Memo;?></textarea>
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
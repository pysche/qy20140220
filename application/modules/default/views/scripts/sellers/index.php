<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => 'welcome',
	  	'module' => $this->MODULE
	  ), null, true);?>" data-transport="ajax">首页</a></li>
	  <li class="active"><?php echo $this->MName;?></li>
	</ol>

	<div class='well well-sm'>
	<form class="form-inline" role="form" method='post' action='<?php echo $this->url(array());?>' data-target='main_content' data-role='search' data-transport='ajax'>
		<div class='form-group'>
			<label>查询字段</label>
		</div>
	  <div class="form-group">

	  	<select class='form-control' name='search_key'>
	  		<?php
	  		foreach ($this->searchKeys as $k=>$v) {
	  		?>
	  		<option value='<?php echo $k;?>'><?php echo $v;?></option>
	  		<?php
	  		}
	  		?>
	  	</select>
	  </div>
	  <div class="form-group">
	    <input type="text" class="form-control" name='Keywords' id="keywords" placeholder="输入关键字" value='<?php echo $this->params['Keywords'];?>' />
	  </div>
	  <div class='form-group'>
	  	<button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
	  </div>
	  
	  <a class='btn btn-success pull-right' href='<?php echo $this->url(array(
	  	'action' => 'add',
	  ));?>' data-target='main_content' data-transport='ajax'>新  增</a>
	</form>
	</div>
	
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			<thead>
				<tr class='success'>
					<th width='7%'>序号</th>
					<th width='12%'>机构编码</th>
					<th width=''>机构名称</th>
					<th width='12%'>机构简称</th>
					<th width='12%'>联系人</th>
					<th width='12%'>地址</th>
					<th width='10%'>状态</th>
					<th width='12%'>药品目录维护</th>
					<th width='10%'>操作</th>
				</tr>
			</thead>
			
			<tbody>
			<?php 
			if (count($this->list)>0) {
				$i = ($this->currentPage-1)*$this->numPerPage + 1;
				foreach ($this->list as $row) {
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->Code;?></td>
				<td><?php echo $row->Name;?></td>
				<td><?php echo $row->ShortName;?></td>
				<td><?php echo $row->Contactor;?></td>
				<td><?php echo $row->Address;?></td>
				<td>
				<?php if ($row->Status) { ?>
				<span class='label label-success'>已启用</span>
				<?php } else { ?>
				<span class='label label-danger'>已禁用</span>
				<?php } ?>
				</td>
				<td>
					<a class='label label-success' href='<?php echo $this->url(array(
						'module' => $this->MODULE,
						'controller' => $this->cName,
						'action' => 'medicines',
						'seller_id' => $row->id
					), null, true);?>' data-target='seller_medicines' data-transport='modal'>设置目录</a>
				</td>
				<td>
				<a class='label label-primary' href='<?php echo $this->url(array(
					'action' => 'edit',
					'id' => $row->id
				));?>' data-target='main_content' data-transport='ajax'>修改</a> 
				<a class='label label-danger' href='<?php echo $this->url(array(
					'action' => 'delete',
					'id' => $row->id
				));?>' data-target='main_content' data-transport='ajax'>删除</a></td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr>
				<td colspan='10' class='td_alert'>
					<div class='alert alert-danger'>
					暂无数据
					</div>
				</td>
			</tr>
			<?php 
			}
			?>
			</tbody>
		</table>
		
		<div class='pull-right'>
			<?php echo $this->Pager($this->currentPage, $this->totalCount, $this->numPerPage);?>
		</div>
	</div>
</div>

<div class="modal fade" id='seller_medicines' data-role='modal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id='seller_medicines_body'>
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">关闭</button>
        <button type="button" class="btn btn-danger" id='save_directory'>保存</button>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
var eurl = '<?php echo $this->url(array(
	'action' => 'set_medicines',
	'controller' => $this->cName,
	'module' => $this->MODULE
	), null, true);?>';
$(function () {
	$('#save_directory').unbind('click').bind('click', function () {
		var form = $('#seller_medicines_body form[name="list"]');
		var ids = [];
		var cbs = form.find(':checked').each(function () {
			var $this = $(this);
			ids.push($this.val());
		});
		var transId = form.find('#seller_id').val();

		$.bcAjax({
			'url': eurl,
			'data': {
				'ids': ids,
				'id': transId
			},
			'history': 'false',
			'type': 'post',
			'format': 'json',
			'success': function (json) {
				$('#seller_medicines').modal('hide');
				msgSuccess('操作成功！');
			}
		});
	});
});
</script>
<?php Bc_Output::doOutput();?>
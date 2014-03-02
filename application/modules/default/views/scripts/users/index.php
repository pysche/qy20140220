<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<ol class="breadcrumb">
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => 'welcome',
	  	'module' => $this->MODULE
	  ), null, true);?>" data-transport="ajax">首页</a></li>
	  <li class="active">系统用户管理</li>
	</ol>

	<div class='well well-sm'>
	<form class="form-inline" role="form" method='post' action='<?php echo $this->url(array());?>' data-target='main_content' data-role='search' data-transport='ajax'>
	  <div class="form-group">
	    <label class="sr-only" for="username_keyword">用户名</label>
	    <input type="text" class="form-control" name='Username' id="username_keyword" placeholder="用户名" value='<?php echo $this->params['Username'];?>' />
	  </div>
	  <div class='form-group'>
	  <label class='sr-only' for='role'>身份</label>
	  <?php echo $this->formSelect('Role', $this->params['Role'], array(
	  	'class' => 'form-control'
	  	), array_merge(array(''=>'* 用户身份 *'), $this->config->auth->role->toArray()));?>
	  </div>
	  <div class='form-group'>
	  	<button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
	  </div>
	  
	  <a class='btn btn-success pull-right' href='<?php echo $this->url(array(
	  	'action' => 'add',
	  ));?>' data-target='main_content' data-transport='ajax'>新建用户</a>
	</form>
	</div>
	
	<div class='table-responsive'>
		<table class="table table-condensed table-hover table-striped">
			<thead>
				<tr class='success'>
					<th width='5%'>#</th>
					<th width='12%'>用户名</th>
					<th width='12%'>姓名</th>
					<th>身份</th>
					<th width='12%'>邮件</th>
					<th width='15%'>最后登录</th>
					<th width='10%'>状态</th>
					<th width=''>备注</th>
					<th width='10%'>操作</th>
				</tr>
			</thead>
			
			<tbody>
			<?php 
			if (count($this->list)>0) {
				$i = ($this->currentPage-1)*$this->numPerPage + 1;
				$roles = $this->config->auth->role->toArray();
				foreach ($this->list as $row) {
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->Username;?></td>
				<td><?php echo $row->Realname;?></td>
				<td><?php echo $roles[$row->Role];?></td>
				<td><?php echo $row->Email;?></td>
				<td><?php echo $row->LastLogin ? substr($row->LastLogin, 0, 16) : '--';?></td>
				<td>
				<?php if ($row->Status) { ?>
				<span class='label label-success'>已启用</span>
				<?php } else { ?>
				<span class='label label-danger'>已禁用</span>
				<?php } ?>
				</td>
				<td><?php echo $row->Remark;?></td>
				<td>
				<a class='label label-primary' href='<?php echo $this->url(array(
					'action' => 'edit',
					'id' => $row->id
				));?>' data-target='main_content' data-transport='ajax'>修改</a> 
				<?php 
				if ($row->id != $this->user['id']) {
				?>
				<a class='label label-danger' href='<?php echo $this->url(array(
					'action' => 'delete',
					'id' => $row->id
				));?>' data-target='main_content' data-transport='ajax' data-confirm='1'>删除</a>
				<?php } ?>
				</td>
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
<?php Bc_Output::doOutput();?>
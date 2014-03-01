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

	  <div class="form-group">
	    <input type="text" class="form-control" name='Keywords' id="keywords" placeholder="输入公告标题查询" value='<?php echo $this->params['Keywords'];?>' />
	  </div>
	  <div class='form-group'>
		<button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
		</div>
	  
	  <a class='btn btn-success pull-right' href='<?php echo $this->url(array(
	  	'action' => 'add',
	  ));?>' data-transport='ajax'>新  增</a>
	</form>
	</div>
	
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			<thead>
				<tr class='success'>
					<th width='7%'>序号</th>
					<th width=''>公告标题</th>
					<th width=''>录入时间</th>
					<th width=''>浏览次数</th>
					<th width=''>是否发布</th>
					<th width='15%'>操作</th>
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
				<td><?php echo $row->Title;?></td>
				<td><?php echo substr($row->CreateTime, 0, 16);?></td>
				<td><?php echo $row->Views;?></td>
				<td>
				<?php if ($row->Status) { ?>
				<span class='label label-success'>已启用</span>
				<?php } else { ?>
				<span class='label label-danger'>已禁用</span>
				<?php } ?>
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
				<td colspan='20' class='td_alert'>
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
<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<div class='well well-sm'>
	<form class="form-inline" role="form" method='post' action='<?php echo $this->url(array());?>' data-target='main_content' data-role='search' data-transport='ajax'>
	  <div class="form-group">
	    <label class="sr-only" for="username_keyword">关键字</label>
	    <input type="text" class="form-control" name='Username' id="username_keyword" placeholder="关键字" value='<?php echo $this->params['Username'];?>' />
	  </div>
	  <button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
	  
	  <a class='btn btn-success pull-right' href='<?php echo $this->url(array(
	  	'action' => 'add',
	  ));?>' data-target='main_content' data-transport='ajax'>新建用户</a>
	</form>
	</div>
	
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			
			
			<tbody>
			<?php 
			if (count($this->list)>0) {
				$i = ($this->currentPage-1)*$this->numPerPage + 1;
				foreach ($this->list as $row) {
			?>
			<tr>
				<td><?php echo $i++;?></td>
				<td><?php echo $row->Username;?></td>
				<td><?php echo $row->Realname;?></td>
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
				<a class='label label-danger' href='<?php echo $this->url(array(
					'action' => 'delete',
					'id' => $row->id
				));?>' data-target='main_content' data-transport='ajax'>删除</a></td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr class='danger'>
				<td colspan='10' class='danger'>
					<p class='text-center'>
					暂无数据
					</p>
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
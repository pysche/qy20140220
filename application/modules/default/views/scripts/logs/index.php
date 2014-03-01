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
	</form>
	</div>
	
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			<thead>
				<tr class='success'>
					<th width='7%'>序号</th>
					<th width=''>日志标题</th>
					<th width=''>日志内容</th>
					<th width=''>操作人</th>
					<th width=''>日志内容描述</th>
					<th width=''>日志时间</th>
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
				<td><?php echo $row->Content;?></td>
				<td>
				<?php echo $row->Actor;?>
				</td>
				<td>
				<?php echo $row->Memo;?>
				</td>
				<td>
				<?php echo $row->CreateTime;?>
				</td>
			</tr>
			<?php
				}
			} else {
			?>
			<tr>
				<td colspan='20' class='td_alert'>
					<div class='alert alert-danger text-center'>
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
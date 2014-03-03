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
	  	'ParentId' => $this->ParentId
	  ));?>' data-transport='ajax'>新  增</a>
	</form>
	</div>
	
	<?php if ($this->ParentId) {
	?>
	<div class='well well-sm well-sm-origin'>
	<a href='<?php echo $this->url(array(
		'ParentId' => 0
	));?>' data-transport='ajax'>顶级地区</a> -&gt; 
	<?php 
		for ($i=count($this->fids)-1;$i>=0;$i--) {
			$row = $this->fids[$i];
			?>
			<a href='<?php echo $this->url(array(
				'ParentId' => $row[0]
			));?>' data-transport='ajax'><?php echo $row[1];?></a> 
			<?php if ($i>0) { ?>
			-&gt; 
			<?php 
			}
		}
	?>
	</div>
	<?php 
	} 
	?>
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			<thead>
				<tr class='success'>
					<th width='7%'>序号</th>
					<th width=''>地区名</th>
					<th width=''>排序值</th>
					<th width='120'>操作</th>
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
				<td><a href='<?php echo $this->url(array(
					'ParentId' => $row->id
				));?>' data-role='inner_link' data-transport='ajax'><?php echo $row->Name;?></a></td>
				<td><?php echo $row->Sort;?></td>
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
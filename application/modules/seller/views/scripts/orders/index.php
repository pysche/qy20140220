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
					<th>订单号</th>
					<th>当前状态</th>
					<th width=''>药品名称</th>
					<th>数量</th>
					<th>总价</th>
					<th>实际到货数</th>
					<th>实际总价</th>
					<th>买方</th>
					<th width='100'>操作</th>
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
				<td><?php echo $row['Code'];?></td>
				<td><?php echo $row['Status'];?></td>
				<td><?php echo $row['MedicineName'];?></td>
				<td><?php echo $row['Nums'];?></td>
				<td><?php echo $row['Total'];?></td>
				<td><?php echo $row['FinalNums'];?></td>
				<td><?php echo $row['FinalTotal'];?></td>
				<td><?php echo $row['BuyerName'];?></td>
				<td>
					<a href='<?php echo $this->url(array(), null ,true);?>' data-transport='ajax' class='btn btn-success'>查看</a>
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
			<?php echo $this->Pager($this->pager['page'], $this->count, $this->pager['limit']);?>
		</div>
	</div>
</div>

<?php Bc_Output::doOutput();?>
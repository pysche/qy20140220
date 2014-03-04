<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<ol class="breadcrumb">
	  <li class="active">设定药品目录</li>
	</ol>

	<div class='well well-sm'>
	<form class="form-inline" data-history='false' role="form" data-target='buyer_medicines_body' method='post' action='<?php echo $this->url(array(
		
	));?>' data-role='search' data-transport='ajax'>
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
			<label>每页显示条目</label>
		</div>
	  <div class="form-group">
	  	<?php echo $this->formSelect('limit', $this->params['limit'] ? (int)$this->params['limit'] : 10, array(
	  		'class' => 'form-control'
	  	), array(
	  		'10' => '系统默认',
			'50' => '每页50',
			'100' => '每页100',
			'999999' => '全部'
	  	));?>
	  </div>
	  <div class='form-group'>
	  	<button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
	  </div>
	</form>
	</div>
	
	<form name='list'>
	<div class='table-responsive'>
		<table class="table table-condensed table-hover">
			<thead>
				<tr class='success'>
					<th width='7%'>序号</th>
					<th width=''>名称</th>
					<th width=''>通用名</th>
					<th width=''>剂型</th>
					<th width=''>规格</th>
					<th width=''>单位</th>
					<th width=''>采购价</th>
					<th>操作</th>
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
				<td><?php echo $row['Name'];?></td>
				<td><?php echo $row['ProdName'];?></td>
				<td>
				<?php echo $row['DosageForm'];?>
				</td>
				<td>
				<?php echo $row['Spec'];?>
				</td>
				<td>
				<?php echo $row['Unit'];?>
				</td>
				<td>
				<?php echo $row['OriginPrice'];?>
				</td>
				<td>
				<?php echo $this->formCheckbox('choosed[]', $row['id'], array(
					'checked' => (int)$row['Choosed']>0 ? true : false
				));?>
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
	<input type='hidden' id='buyer_id' value='<?php echo (int)$this->params['buyer_id'];?>' />
</form>
</div>
<?php Bc_Output::doOutput();?>
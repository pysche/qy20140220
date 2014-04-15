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
	  <div class="form-group">
	  	<label>每页显示数量</label>
	  </div>
	  <div class="form-group">
	  	<?php 
	  	echo $this->formSelect('limit', $this->pager['limit'], array(
	  		'class' => 'form-control'
	  		), $this->config->pager->pages->toArray());
	  	?>
	  </div>
	  <div class='form-group'>
	  	<button type="submit" class="btn btn-primary" data-role='search'>搜索</button>
	  </div>
	</form>
	</div>
	
	<form id='medicines_list'>
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
					<th width=''>价格</th>
					<th width=''>生产企业</th>
					<th width=''>配送企业</th>
					<th>基本药物</th>
					<th>二级医院<br />基本药物</th>
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
				<td><?php echo $row['Name'];?></td>
				<td><?php echo $row['ProdName'];?></td>
				<td><?php echo $row['DosageForm'];?></td>
				<td><?php echo $row['Spec'];?></td>
				<td><?php echo $row['Unit'];?></td>
				<td><?php echo $row['ImportPrice'];?></td>
				<td>--</td>
				<td>--</td>
				<td>
				<?php 
				if ((int)$row['IsBasic']>0) {
				?>
				<label class='label label-success'>是</label>
				<?php 
				} else {
				?>
				<label class='label label-danger'>否</label>
				<?php 
				}
				?>
				</td>
				<td><?php 
				if ((int)$row['IsLevel2Basic']>0) {
				?>
				<label class='label label-success'>是</label>
				<?php 
				} else {
				?>
				<label class='label label-danger'>否</label>
				<?php 
				}
				?>
				</td>
				<td>
				<?php
				echo $this->formCheckbox('choosed[]', $row['id']);
				?>
				</td>
			</tr>
			<?php
				}
			?>
			<tr class='success'>
				<td colspan='20'>
					<div class='text-center'>
						<button type='button' class='btn btn-warning' data-role='reverse_all' data-target='medicines_list'>反选</button>
						<button type='button' class='btn btn-success' data-role='choose_all' data-target='medicines_list'>全选</button>
						<button type='button' class='btn btn-danger' data-role='unchoose_all' data-target='medicines_list'>全不选</button>

					</div>
				</td>
			</tr>
			<tr class='warning'>
				<td colspan='20'>
					<div class='text-center'>
						<button type='button' class='btn btn-warning' id='mass_set_default_trans' data-role='mass_action' data-from='medicines_list' data-target='modal' data-action='<?php echo $this->url(array(
							'module' => $this->MODULE,
							'controller' => $this->cName,
							'action' => 'doexport'
						), null, true);?>'>导出所选</button> 
					</div>
				</td>
			</tr>
			<?php
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
</div>

<?php Bc_Output::doOutput();?>
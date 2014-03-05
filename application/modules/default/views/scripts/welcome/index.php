<?php Bc_Output::prepareHtml();?>

	<ol class="breadcrumb">
	  <li><a href="<?php echo $this->url(array(
	  	'controller' => 'welcome',
	  	'module' => $this->MODULE
	  ), null, true);?>" data-transport="ajax">首页</a></li>
	</ol>

<div class='alert alert-success'>
	<?php echo $this->user->Realname;?> 您好，欢迎使用<?php echo Bc_Config::appConfig()->app_name;?>。 现在时间是 <?php echo date('Y-m-d H:i:s');?>
	<?php if ($this->LastLogin) { ?>
	，您上次登录时间是：<?php echo $this->LastLogin;?>
	<?php } ?>
	。
</div>

<div class='row'>
	<div class='col-md-6'>
		<h4>待办事项</h4>

		<table class='table table-hover table-striped'>
		<tr>
			<th width='10%'>序号</th>
			<th width='25%'>类别</th>
			<th>详情</th>
			<th width='25%'>操作</th>
		</tr>

		<?php
		if (count($this->todos)>0) {
			$i = 1;
			foreach ($this->list as $row) {
			?>
			<tr>
				<td><?php echo $i;?></td>
				<td><?php echo $row->Title;?></td>
				<td><?php echo substr($row->CreateTime, 0, 16);?></td>
				<td><a href='#' data-role='inner_link' class='label label-danger'>立即处理</a></td>
			</tr>
			<?php
				$i++;
			}
		} else {
			?>
			<tr>
				<td class='td_alert' colspan='10'>
					<div class='alert alert-success'>暂无待办事项</div>
				</td>
			</tr>
			<?php
		}
		?>
		</table>
	</div>

	<div class='col-md-6'>
		<h4>系统公告</h4>
		<table class='table table-hover table-striped'>
		<tr>
			<th width='10%'>序号</th>
			<th>公告标题</th>
			<th width='25%'>发布时间</th>
		</tr>

		<?php
		$i = 1;
		foreach ($this->list as $row) {
		?>
		<tr>
			<td><?php echo $i;?></td>
			<td><a href='<?php echo $this->url(array(
				'module' => 'default',
				'controller' => 'public',
				'action' => 'announce',
				'id' => $row->id
			), null, true);?>' data-target='mwelcome' data-transport='modal'><?php echo $row->Title;?></a></td>
			<td><?php echo substr($row->CreateTime, 0, 16);?></td>
		</tr>
		<?php
			$i++;
		}
		?>
		</table>
	</div>
</div>
<hr />
<h4>日历</h4>
<div class='row'>
	<div class='col-md-12'>
		<div class='well well-sm'>
			<!--  -->
			<div id='calendar'></div>
			<!--  -->
		</div>
	</div>
</div>


<div class="modal fade" id='mwelcome' data-role='modal'>
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" id='mwelcome_body'>
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">关闭</button>
      </div>
    </div>
  </div>
</div>

<script type='text/javascript'>
$(function() {
	var options = {
		'day': '<?php echo date('Y-m-d');?>',
		'events_source': [],
		'tmpl_path': 'assets/calendar/tmpls/',
		'tmpl_cache': false,
		'language': 'zh-CN'
	};
	$('#calendar').calendar(options);
});
</script>
<?php Bc_Output::doOutput();?>
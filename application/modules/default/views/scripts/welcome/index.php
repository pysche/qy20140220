<?php Bc_Output::prepareHtml();?>
<div class='alert alert-success'>
	<?php echo $this->user->Realname;?> 您好，欢迎使用<?php echo Bc_Config::appConfig()->app_name;?>。 现在时间是 <?php echo date('Y-m-d H:i:s');?>
	<?php if ($this->LastLogin) { ?>
	，您上次登录时间是：<?php echo $this->LastLogin;?>
	<?php } ?>
	。
</div>

<div class='row'>
	<div class='col-md-6'>
		<div class='well well-sm'>
			<!--  -->
			<div id='calendar'></div>
			<!--  -->
		</div>
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
			<td><?php echo $row->Title;?></td>
			<td><?php echo substr($row->CreateTime, 0, 16);?></td>
		</tr>
		<?php
			$i++;
		}
		?>
		</table>
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
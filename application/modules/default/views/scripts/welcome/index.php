<?php Bc_Output::prepareHtml();?>
<div class='alert alert-success'>
	<?php echo $this->user->Realname;?> 您好，欢迎使用<?php echo Bc_Config::appConfig()->app_name;?>。 现在时间是 <?php echo date('Y-m-d H:i:s');?>
	<?php if ($this->LastLogin) { ?>
	，您上次登录时间是：<?php echo $this->LastLogin;?>
	<?php } ?>
	。
</div>

<div class='row'>
	<div class='col-xs-12 col-sm-12 col-md-12'>
		<div class='well well-sm'>
			<!--  -->
			<div id='calendar'></div>
			<!--  -->
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
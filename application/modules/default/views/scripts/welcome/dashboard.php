<?php Bc_Output::prepareHtml();?>
<div class='alert alert-success'>
	<?php echo $this->user->Realname;?> 您好，欢迎使用WeShop管理平台。 现在时间是 <?php echo date('Y-m-d H:i:s');?>
	<?php if ($this->LastLogin) { ?>
	，您上次登录时间是：<?php echo $this->LastLogin;?>
	<?php } ?>
	。
</div>

<div class='row'>
	<div class='col-xs-12 col-sm-6 col-md-8'>
		<div class='well well-sm'>
			<!--  -->
			<div id='calendar'></div>
			<!--  -->
		</div>
	</div>
	
	<div class='col-xs-6 col-md-4'>
		<div class='well well-sm'>
			<h4>当前站点信息</h4>
			<ul>
				<li>站点名: <?php echo $this->site['Name'];?></li>
				<li>当前状态：
				<?php 
				if ((int)$this->site['Enabled']==1) {
				?>
				<span class='label label-success'>已激活</span>
				<?php
				} else {
				?>
				<span class='label label-danger'>未激活</span>
				<?php
				}
				?>
				</li>
				<li>可用域名：
					<ol>
						<?php 
						$ds = $this->site['Domains'] ? explode("\n", $this->site['Domains']) : array();
						foreach ($ds as $domain) {
						?>
						<li><?php echo $domain;?></li>
						<?php
						}
						?>
					</ol>
				</li>
			</ul>
			
			<div></div>
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
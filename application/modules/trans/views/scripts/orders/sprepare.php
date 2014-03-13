<script type='text/javascript'>
$(function () {
	$('[data-role="modal"]').modal('hide').removeClass('fade');

	$.bcAjax({
		'url': '<?php echo $this->url(array(
			'module' => $this->MODULE,
			'controller' => $this->cName,
			'action' => 'pending'
			), null, true);?>'
	});	
});
</script>
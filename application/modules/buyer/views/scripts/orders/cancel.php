<script type='text/javascript'>
$(function () {
	$('[data-role="modal"]').modal('hide');

	$.bcAjax({
		'url': '<?php echo $this->url(array(
			'module' => $this->MODULE,
			'controller' => $this->cName
			), null, true);?>'
	});	
});
</script>
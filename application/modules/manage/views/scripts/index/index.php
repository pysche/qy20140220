<?php include dirname(__FILE__).'/../include/header.php'; ?>
<?php include dirname(__FILE__).'/../include/top.php'; ?>

<div class="container">
	<div class='row'>
		<div class='col-md-12' id='main_content'>
		
		</div>
	</div>
</div>
<iframe class='hide' id='form_target' name='form_target'></iframe>
<div id='script_target' class='hidden'></div>
<?php include dirname(__FILE__).'/../include/script.php';?>
<script type='text/javascript'>
$(function() {
	try {
		var hash = window.location.hash
		if (hash) {
			_location = hash.substr(1);
			if (_location) {
				$.bcAjax({
					'url': _location
				});
			} else {
				$('ul.nav.navbar-nav li:first a').trigger('click');
			}
		} else {
			$('ul.nav.navbar-nav li:first a').trigger('click');
			$('.left-menu .list-group a.list-group-item.active').trigger('click');
		}
	} catch (e) {
		console.log(e);
		$('ul.nav.navbar-nav li:first a').trigger('click');
	}
});
</script>
<?php include dirname(__FILE__).'/../include/footer.php'; ?>
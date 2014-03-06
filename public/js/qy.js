var LAST_HASH = '';
var EDITOR_LOADED = false;

function Bc_FormatFileSize(size) {
	re = '';
	
	if (size >= 1048576) {
		re = (Math.round(size / 1048576 * 100) / 100) + 'MB';
	} else if (size >= 1024) {
		re = (Math.round(size / 1024 * 100) / 100) + 'KB';
	} else {
		re = size + 'B';
	}
	
	return re;
};

function Bc_Debug(e) {
	if (DEBUG) {
		console.log(e);
	}
};

function Bc_ConfirmLink(e) {
	return confirm('确定吗?');
};

function msgSuccess(msg) {
	$('#ajax_loading,#msg_error,#msg_success').hide();
	$('#msg_success').slideDown();
	$('#msg_success_content').html(msg);
	
	setTimeout(function () {
		$('#msg_success').slideUp();
	}, 3000);
};

function msgError(msg) {
	$('#ajax_loading,#msg_error,#msg_success').hide();
	$('#msg_error_content').html(msg);
	$('#msg_error').slideDown();
};

function Bc_CreateEditor(dom) {
	callback = function () {
	    KindEditor.create(dom, {
	      themeType : 'qq',
	      items : [
	        'bold','italic','underline','fontname','fontsize','forecolor','hilitecolor','plug-align','plug-order','plug-indent','link'
	      ]
	    });
	};

	if (!EDITOR_LOADED) {
	 $.getScript('/js/kindeditor/kindeditor-min.js', function() {
	    KindEditor.basePath = '/js/kindeditor/';

	    EDITOR_LOADED = true;

	    callback();
	  });
	} else {
		callback();
	}
};

$.bcAjax = function(options, target) {
	var target = typeof target == 'undefined' ? 'main_content' : target;
	var format = 'html';
	var history = true;
	
	if (typeof options.format != 'undefined') {
		format = options.format;
		delete options.format;
	}
	
	if (typeof options.history != 'undefined' && options.history == 'false') {
		history = false;
	} else {
		LAST_HASH = options.url;
	}
	
	options.cache = false;

	options.beforeSend = function() {
		$('#ajax_loading').fadeIn();
		return true;
	};

	options.complete = function() {
		$('#ajax_loading').fadeOut();
		return true;
	};

	options.error = function(xhr, textStatus, errorThrown) {
		return false;
	};
	
	if (typeof options.success == 'undefined') {
		options.success = function (html) {
			if (format=='html') {
				Bc_bindEvents($('#'+target).empty().append($(html)));
				
				if (typeof options.after_success != 'undefined' && $.isFunction(options.after_success)) {
					options.after_success();
				}
			} else if (format=='json') {
				var json = JSON.parse(html);
			} else if (format=='script') {
				$('#script_target').html(html);
			}
		};
	}

	if (history===true) {
		window.location = REQUEST_URI+'#'+options.url;
	}
	
	$.ajax(options);
};

function Bc_bindEvents(dom) {
	dom.find('a[data-confirm="1"]').click(Bc_ConfirmLink);
	
	dom.find('a[data-transport="ajax"]').click(function (e) {
		e.preventDefault();
		var url = $(this).attr('href');
		var target = $(this).attr('data-target');
		
		$.bcAjax({
			'url': url,
			'history': $(this).attr('data-history'),
			'format': $(this).attr('data-format')
		}, target);
		
		return false;
	});
	
	dom.find('a[data-transport="modal"]').click(function (e) {
		e.preventDefault();
		var url = $(this).attr('href');
		var target = $(this).attr('data-target');
		var modal = $('#'+target);
		var mtarget = target+'_body';
		
		$.bcAjax({
			'url': url,
			'after_success': function () {
				var left = parseInt($(document).width()*3/20);
				var top = 100;
				modal.children().css({
					'left': left+'px',
					'top': top+'px'
				});
				modal.modal('show');
			},
			'history': 'false'
		}, mtarget);
		
		return false;
	});

	dom.find('form').submit(function (e) {
		$('#ajax_loading').fadeIn();
	});
	
	dom.find('form[data-transport="ajax"]').submit(function () {
		var $this = $(this);
		var $action = $this.attr('action');
		var $method = $this.attr('method') ? $this.attr('method') : 'post';
		var $redirect = $this.attr('data-redirect');
		var $target = $this.attr('data-target');
		var $history = $this.attr('data-history');
		
		$.bcAjax({
			'url': $action,
			'data': $this.serialize(),
			'type': $method,
			'history': $history
		}, $target);
		
		return false;
	});
	
	dom.find('div[data-role="modal"]').modal({
		'show': false,
		'keyboard': true
	});
	
	dom.find('input[data-role="datepicker"]').datepicker({
		'dateFormat': 'yy-mm-dd'
	});

  	Bc_CreateEditor(dom.find('textarea[data-role="kindeditor"]'));

  	dom.find('form textarea[data-role="kindeditor"]').submit(function () {
  		KindEditor.sync('[data-role="kindeditor"]');
  	});

  	dom.find('button[data-role="choose_all"]').click(function () {
  		var $this = $(this);
  		var target = $this.attr('data-target');
  		$('form#'+target+' :checkbox:checked').trigger('click');
  		$('form#'+target+' :checkbox').trigger('click');
  		
  		return false;
  	});

  	dom.find('button[data-role="unchoose_all"]').click(function () {
  		var $this = $(this);
  		var target = $this.attr('data-target');
  		$('form#'+target+' :checkbox').attr('checked', false);
  		
  		return false;
  	});

  	dom.find('button[data-role="reverse_all"]').click(function () {
  		var $this = $(this);
  		var target = $this.attr('data-target');
  		$('form#'+target+' :checkbox').trigger('click');
  		
  		return false;
  	});

  	dom.find('button[data-role="mass_action"]').click(function (e) {
  		var $this = $(this);
  		var $from = $this.attr('data-from');
  		var choosed = $('#'+$from+' :checkbox:checked').size();

  		if (choosed<=0) {
  			e.preventDefault();
  			msgError('请先选择要处理的数据！');
  		} else {
  			if (confirm('确定吗？')) {
	  			var $target = $this.attr('data-target');
	  			var $action = $this.attr('data-action');
	  			var choosed = [];
	  			$('#'+$from+' :checkbox:checked').each(function () {
	  				choosed.push($(this).val());
	  			});

				$.bcAjax({
					'url': $action,
					'type': 'post',
					'data': {
						'choosed': choosed
					},
					'history': 'false',
					'success': function (result) {
						switch ($target) {
							case 'ajax':
	  							msgSuccess('操作成功！');
	  							$.bcAjax({
	  								'url': LAST_HASH,
	  								'history': 'false'
	  							});
								break;
							case 'modal':
								$(result).modal();
								break;
						}
					}
				});
	  		}
  		}

  		return false;
  	});
};

function gotoUrl(url) {
	$.bcAjax({
		'url': url
	});
};

$(function() {
	$thisMenu = $('ul.nav.navbar-nav li[data-key="'+CONTROLLER+'"]');
	
	if ($thisMenu.size()>0) {
		$thisMenu.addClass('active');
	} else {
		$('ul.nav.navbar-nav li:first').addClass('active');
	}

	$('ul.nav.navbar-nav li[data-role="menu_item"]').hover(function () {
		$(this).parent().find('li:first').removeClass('active');
		$(this).find('a[data-toggle="dropdown"]').trigger('click');

		return false;
	});

	$('ul.nav.navbar-nav li a[data-role="smenu"]').click(function () {
		var $this = $(this);
		var $parent = $this.parent().parent().parent();

		$parent.parent().find('li[data-role="menu_item"]').removeClass('active');
		$parent.addClass('active');
	});
	
	Bc_bindEvents($('body'));
});
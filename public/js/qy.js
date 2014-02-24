var LAST_HASH = '';

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

function Bc_AttachListOrders(id) {
	var aobj = $('[data-role="'+id+'"]').eq(0);
	size = aobj.find('li').size();
	
	if (size>0) {
		obj = $('[data-role="'+id+'_orders"]');
		tmp = [];
		
		aobj.find('li').each(function(i){
			tmp.push($(this).attr('fid'));
		});
		
		obj.val(tmp.join(','));
	}
};

function Bc_BindAttachSortAndDrag() {
	$('[data-role="attach_list"], [data-role="attach_list"] li').disableSelection();
};

function Bc_DelAttachRow(event) {
	var fid = $(this).attr('fid');

	if (confirm('确定？')) {
		$.getJSON('files/upload/del?fid='+fid, function(){
			$('li[fid="'+fid+'"]').remove().replaceWith('');
			$('input[type="hidden"][value="'+fid+'"]').remove().replaceWith('');
		});
	}
	
	return false;
}

function Bc_AppendAttachRow(d, key)
{
	key = key ? key : 'attach_list';
	
	fid = d.id;

	a = $(document.createElement('a')).attr('fid', fid).attr('href', '#').text('删除').bind('click', Bc_DelAttachRow);
	_d = fid.substr(0,1);
	_d2 = fid.substr(1, 1);
	li = $(document.createElement('li')).attr('fid', fid).append('<a href="/files/'+_d+'/'+_d2+'/'+fid+'.'+d.Ext+'" target="_blank">'+d.Name+'</a>&nbsp;'+Bc_FormatFileSize(d.Size)).append('&nbsp;').append(a);
	ip = $(document.createElement('input')).attr('type', 'hidden').attr('name', 'fids[]').val(fid);

	$('ol[data-role="'+key+'"]').append(li);
	$('[data-role="'+key+'_hide"]').append(ip);
	
	obj = $('[data-role="'+key+'_orders"]');
	if (obj.val()=='') {
		obj.val(fid);
	}
	
	Bc_BindAttachSortAndDrag();
}

function Bc_ConfirmLink(e) {
	return confirm('确定吗?');
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
			}
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
		
		$.bcAjax({
			'url': $action,
			'data': $this.serialize(),
			'type': $method
		});
		
		return false;
	});
	
	dom.find('div[data-role="modal"]').modal({
		'show': false,
		'keyboard': true
	});
	
	dom.find('input[data-role="datepicker"]').datepicker({
		'dateFormat': 'yy-mm-dd'
	});
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
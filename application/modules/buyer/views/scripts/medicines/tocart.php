<?php Bc_Output::prepareHtml();?>
<div class='row'>
	<table class='table'>
		<tr>
			<td width='15%'>
				<div class='alert alert-info'>名称</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->Name;?>
				</div>
			</td>
			<td width='15%'>
				<div class='alert alert-info'>通用名称</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->ProdName ? $this->vo->ProdName : '--';?>
				</div>
			</td>
		</tr>

		<tr>
			<td width='15%'>
				<div class='alert alert-info'>规格型号</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->DosageForm ? $this->vo->DosageForm : '--';?>
				</div>
			</td>
			<td width='15%'>
				<div class='alert alert-info'>产地</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->OriginPlace ? $this->vo->OriginPlace : '--';?>
				</div>
			</td>
		</tr>

		<tr>
			<td width='15%'>
				<div class='alert alert-info'>用途</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->Usage ? $this->vo->Usage : '--';?>
				</div>
			</td>
			<td width='15%'>
				<div class='alert alert-info'>价格</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->ImportPrice ? $this->vo->ImportPrice.' ￥' : '--';?>
				</div>
			</td>
		</tr>

		<tr>
			<td width='15%'>
				<div class='alert alert-info'>计量单位</div>
			</td>
			<td width='35%'>
				<div class='alert'>
					<?php echo $this->vo->Unit ? $this->vo->Unit : '--';?>
				</div>
			</td>
			<td width='15%'>
				
			</td>
			<td width='35%'>
				<div class='alert'>
				
				</div>
			</td>
		</tr>
	</table>
</div>
<hr />
<div class='row'>
  
  <form class="form-horizontal" role="form" method='post' action='<?php echo $this->url(array(
    'controller' => $this->cName,
    'action' => 'savecart',
    'module' => $this->MODULE
  ), null, true);?>' data-trasport='ajax' data-redirect='<?php echo $this->url(array(
    'controller' => $this->cName,
    'action' => 'index',
    'module' => $this->MODULE
  ), null, true);?>' target='form_target'>

    <div class="form-group">
      <label for="Nums" class="col-sm-2 control-label">购买数量</label>
      <div class="col-sm-4">
        <input type="text" class="form-control" id="Nums" name="Nums" placeholder="请填写购买数量" required value='' />
      </div>
      <div class='col-sm-2'>
      	<label class='control-label'><?php echo $this->vo->Unit;?></label>
      </div>
    </div>
    <div class="form-group">
      <label for="Total" class="col-sm-2 control-label">总价</label>
      <div class="col-sm-4">
        <div class='alert' id='total_price'><div class='badge badge-danger' id='bg_total'>1000</div> ￥</div>
      </div>
    </div>
    <div class="form-group">
      <label for="Trans" class="col-sm-2 control-label">配送企业</label>
      <div class="col-sm-10">
        <?php echo $this->formSelect('TransId', 0, array(
        	'class' => 'form-control'
        ), $this->transArr);?>
      </div>
    </div>
    <div class="form-group">
      <label for="Memo" class="col-sm-2 control-label">其他说明</label>
      <div class="col-sm-10">
        <textarea name='Memo' id='Memo' rows='5' class='form-control'></textarea>
      </div>
    </div>
  </form>
</div>

<script type='text/javascript'>
var PRICE = parseFloat('<?php echo $this->vo->ImportPrice;?>');
var ID = parseInt('<?php echo $this->vo->id;?>');
$(function () {
	$('#Nums').keyup(function () {
		var $this = $(this);
		var nums = parseInt($this.val());
		var total = nums ? nums*PRICE : 0;
		var tmp = total.toString().split('.');
		if (tmp.length>1) {
			total = tmp[0]+'.'+tmp[1].substr(0, 2);
		} 

		$('#bg_total').text(total);
	});

	$('#save_cart').unbind('click').bind('click', function() {
		var nums = parseInt($('#Nums').val());
		var transId = $('#TransId').val();
		var memo = $('#Memo').val() ? $('#Memo').val() : $('#Memo').text();

		$.bcAjax({
			'url': '<?php echo $this->url(array(
				'module' => $this->MODULE,
				'controller' => $this->cName,
				'action' => 'savecart'
				), null, true);?>',
			'history': 'false',
			'data': {
				'nums': nums,
				'trans_id': transId,
				'id': ID,
				'memo': memo
			},
			'type': 'post',
			'success': function (result) {
				try {
					if (result.id) {
						msgSuccess('下单成功！');

						$('ul[data-role="top_menu"] a[href="/buyer/orders"]').trigger('click');
					} else {
						msgError('下单失败！请联系管理员排查问题。');
					}

					$('#cart_modal').modal('hide');
				} catch (e) {}
			}
		});
	});
});
</script>
<?php Bc_Output::doOutput();?>
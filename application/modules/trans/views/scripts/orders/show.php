<div class='row'>
	<div class='col-md-2'>
		订单号
	</div>
	<div class='col-md-10'>
		<?php echo $this->vo->Code;?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		采购药品
	</div>
	<div class='col-md-10'>
		<?php echo $this->medicine['Name'];?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		采购单位
	</div>
	<div class='col-md-10'>
		<?php echo $this->buyer['Name'];?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		配送企业
	</div>
	<div class='col-md-10'>
		<?php echo $this->trans['Name'];?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		采购数量
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->Nums;?>
	</div>
	<div class='col-md-2'>
		总价
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->Total;?> ￥
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		创建时间
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->CreateTime;?>
	</div>
	<div class='col-md-2'>
		当前状态
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->Status;?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		备注
	</div>
	<div class='col-md-10'>
		<?php echo $this->vo->Memo;?>
	</div>
</div>

<div class='row'>
	<div class='col-md-2'>
		实际到货量
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->FinalNums ? $this->vo->FinalNums : '--';?>
	</div>
	<div class='col-md-2'>
		实际总价
	</div>
	<div class='col-md-4'>
		<?php echo $this->vo->FinalTotal ? $this->vo->FinalTotal : '--';?>
	</div>
</div>

<script type='text/javascript'>
$(function () {

	$('#morder a[data-role="prepare"]').attr('href', '<?php echo $this->url(array(
    	'module' => $this->MODULE,
    	'controller' => $this->cName,
    	'action' => 'sprepare',
    	'id' => $this->vo->id
		), null, true);?>');

	$('#morder a[data-role="sent"]').attr('href', '<?php echo $this->url(array(
    	'module' => $this->MODULE,
    	'controller' => $this->cName,
    	'action' => 'ssent',
    	'id' => $this->vo->id
		), null, true);?>');
});
</script>

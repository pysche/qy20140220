<?php

class OrdersController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '订单编号',
			'Buyer' => '买方机构',
			'Seller' => '卖方机构',
			'Trans' => '配送企业'
			);

		$this->view->MName = $this->MName = '订单查看';
	}
	
}
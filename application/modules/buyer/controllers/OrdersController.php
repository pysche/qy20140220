<?php

class Buyer_OrdersController extends Bc_Controller_Action_Buyer {

	public function init() {
		$this->mName = 'Orders';

		parent::init();
		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '订单号',
			);

		$this->view->MName = $this->MName = '订单浏览';
	}
}
<?php

class BargaingoodsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		$this->mName = 'bargains';

		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '协议代码',
			'Name' => '协议名称',
			);

		$this->view->MName = $this->MName = '协议商品管理';
	}
}
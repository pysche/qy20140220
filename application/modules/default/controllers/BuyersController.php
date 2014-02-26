<?php

class BuyersController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '机构代码',
			'Name' => '机构名称',
			);

		$this->view->MName = $this->MName = '买方机构维护';
	}
}
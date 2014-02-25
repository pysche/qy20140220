<?php

class SellersController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '机构代码',
			'Name' => '机构名称',
			);

		$this->view->MName = $this->MName = '卖方机构管理';
	}

	public function indexAction() {
		
	}

	public function addAction() {

	}
	
}
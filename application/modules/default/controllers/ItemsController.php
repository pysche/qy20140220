<?php

class ItemsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '项目代码',
			'Name' => '项目名称',
			);

		$this->view->MName = $this->MName = '交易项目管理';
	}

	public function indexAction() {
		
	}

	public function addAction() {

	}
	
}
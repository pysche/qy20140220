<?php

class MedicsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '编号',
			'Name' => '名称',
			'NormalName' => '通用名'
			);

		$this->view->MName = $this->MName = '商品管理';
	}

	public function indexAction() {
		
	}

	public function addAction() {

	}
	
}
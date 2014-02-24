<?php

class OrgsController extends Bc_Controller_Action_Weshop {

	public function init() {
		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '单位代码',
			'Name' => '单位名称',
			);

		$this->view->MName = $this->MName = '政府机构维护';
	}

	public function indexAction() {
		
	}
	
	public function addAction() {

	}

	public function editAction() {

	}

	public function deleteAction() {

	}
}
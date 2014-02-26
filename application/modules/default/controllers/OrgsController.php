<?php

class OrgsController extends Bc_Controller_Action_Weshop {

	public function init() {
		$this->force_where = 'Type=\'org\'';
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '单位代码',
			'Name' => '单位名称',
			);

		$this->view->MName = $this->MName = '政府机构维护';
	}

	public function insertAction() {
		$_REQUEST['Type'] = 'org';
		
		parent::insertAction();
	}
}
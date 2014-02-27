<?php

class DirectoriesController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		$this->force_where = 'Type=\'buy\'';
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '机构编码',
			'Buyer' => '机构名称',
			);

		$this->view->MName = $this->MName = '医院采购目录';
	}
	
}
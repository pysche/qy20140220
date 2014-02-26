<?php

class BargainsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '协议代码',
			'Name' => '协议名称',
			);

		$this->view->MName = $this->MName = '平台协议列表';
	}
}
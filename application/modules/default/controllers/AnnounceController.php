<?php

class AnnounceController extends Bc_Controller_Action_Weshop {

	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Title' => '公告标题',
			);

		$this->view->MName = $this->MName = '内部公告管理';
	}
}
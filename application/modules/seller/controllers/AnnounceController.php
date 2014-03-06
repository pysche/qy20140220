<?php

class Seller_AnnounceController extends Bc_Controller_Action_Seller {

	public function init() {
		$this->force_where = 'Status=1';
		$this->mName = 'Announce';

		parent::init();
		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Title' => '公告标题',
			);

		$this->view->MName = $this->MName = '公告浏览';
	}
}
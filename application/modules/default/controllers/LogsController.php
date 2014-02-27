<?php

class LogsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Title' => '日志标题',
			);

		$this->view->MName = $this->MName = '日志查看';
	}
	
}
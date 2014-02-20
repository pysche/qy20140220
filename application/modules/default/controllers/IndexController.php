<?php

class IndexController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
	}
	
	public function indexAction() {
		$this->_helper->getHelper('Redirector')->setExit(true)->gotoSimple('', 'welcome', $this->MODULE);
	}
}
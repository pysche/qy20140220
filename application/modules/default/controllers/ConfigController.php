<?php

class ConfigController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
	}

	public function indexAction() {
		$this->view->config = Bc_Config::appConfig()->weshop->toArray();
	}
	
}
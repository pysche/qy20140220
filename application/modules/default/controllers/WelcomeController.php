<?php

class WelcomeController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
	}

	public function indexAction() {
		
	}
	
	public function dashboardAction() {
		$this->view->LastLogin = $this->sess->get('last_login');
		$this->view->site = Bc_Site::get($this->siteId);
	}
}
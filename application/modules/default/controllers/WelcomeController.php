<?php

class WelcomeController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();

		$this->force_where = 'Status=1';
		$this->mName = 'Announce';
	}

	public function indexAction() {
		$this->view->LastLogin = $this->sess->get('last_login');

		parent::indexAction();
	}
}
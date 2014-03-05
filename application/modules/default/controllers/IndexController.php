<?php

class IndexController extends Bc_Controller_Action_Weshop {
	protected $restrictRole = '';

	public function init() {
		parent::init();

		$this->nLogin();
	}
	
	public function indexAction() {
		
	}
}
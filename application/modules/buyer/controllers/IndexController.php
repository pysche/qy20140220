<?php

class Buyer_IndexController extends Bc_Controller_Action_Buyer {

	public function init() {
		parent::init();
		
		$this->nLogin();
	}
	
	public function indexAction() {
		
	}
}
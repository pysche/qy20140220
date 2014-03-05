<?php

class PublicController extends Bc_Controller_Action_Weshop {
	protected $restrictRole = '';
	
	public function init() {
		parent::init();

		$this->nLogin();
	}

	public function indexAction() {
		
	}

	public function announceAction() {
		$id = (int)$this->getRequest()->getParam('id');
		$tAnnounce = &Bc_Db::t('announce');

		$this->view->vo = $tAnnounce->id($id);
	}
}
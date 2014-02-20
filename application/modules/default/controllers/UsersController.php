<?php

class UsersController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
	}

	public function updateAction() {
		$tUser = &Bc_Db::t('users');
		$username = trim($this->getRequest()->getParam('Username'));
		$id = (int)$this->getRequest()->getParam('id');
		
		if ($tUser->exists($username, $id)) {
			$this->view->Errormsg('该用户已存在，请更换一个用户名');
		}
		
		if (!strlen($this->params['Password'])) {
			unset($this->params['Password']);
		}
		
		parent::updateAction();
	}
	
	public function insertAction() {
		$tUser = &Bc_Db::t('users');
		$username = trim($this->getRequest()->getParam('Username'));
		
		if ($tUser->exists($username)) {
			$this->view->Errormsg('该用户已存在，请更换一个用户名');
		}
		
		parent::insertAction();
	}
	
}
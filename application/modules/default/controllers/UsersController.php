<?php

class UsersController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
	}

	public function addAction() {
		$this->view->orgs = $this->_orgsArr();
		parent::addAction();
	}

	public function editAction() {
		$this->view->orgs = $this->_orgsArr();
		parent::editAction();
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
	
	private function &_orgsArr() {
		$cacher = &Bc_Cache_Remote::getInstance();
		$ck = 'uorgs';
		$arr = $cacher->get($ck);

		if (!$arr) {
			$arr = array(
				'' => '* 请设置机构 *'
				);
			$dao = &Bc_Db::t('organization');
			$rows = $dao->simpleAll();
			$names = $this->config->auth->role->toArray();

			foreach ($rows as $row) {
				$k = '		----====	'.$names[$row['Type']].'	====----	';
				if (!$arr[$k]) {
					$arr[$k] = array();
				}

				$arr[$k][$row['id']] = $row['Name'];
			}

			$cacher->set($ck, $arr);
		}

		return $arr;
	}
}
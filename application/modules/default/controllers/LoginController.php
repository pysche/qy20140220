<?php

class LoginController extends Bc_Controller_Action_Weshop {

	public function indexAction() {
		
	}

	public function doAction() {
		$user = $this->getRequest()->getParam('username');
		$pass = $this->getRequest()->getParam('password');
	
		if ($user == '' || $pass == '') {
			$this->view->error = '用户名密码不能为空';
			echo $this->view->render('login/index.php');
			exit(0);
		} else {
			$t = &$this->M('users');
			$row = $t->Username($user);

			if (!$row) {
				$this->view->error = '用户名密码不正确';
				echo $this->view->render('login/index.php');
				exit(0);
			} else {
				$row = $row->toArray();

				if (md5($pass) != $row['Password']) {
					$this->view->error = '用户名密码不正确';
					echo $this->view->render('login/index.php');
					exit(0);
				} else if ((int)$row['Status']==0) {
					$this->view->error = '帐号已停用';
					echo $this->view->render('login/index.php');
					exit(0);
				} else {
					$this->uid = (int)$row['id'];
					$this->view->user = $this->user = $row;
					$this->sess->set('uid', $this->uid);
					$this->sess->set('last_login', $row['LastLogin'] ? $row['LastLogin'] : '');
						
					$t->update(array(
						'LastLogin' => date('Y-m-d H:i:s')
						), $t->getAdapter()->quoteInto('id=?', $this->uid));
						
					$this->_helper->getHelper('Redirector')->setCode(301)->setExit(true)->gotoSimple('', 'index', $this->MODULE);
				}
			}
		}
	}
	
	public function logoutAction() {
		$this->uid = 0;
		$this->sess->set('uid');
		$this->sess->destroy();
		
		$this->_helper->getHelper('Redirector')->setCode(301)->setExit(true)->gotoSimple('', 'login', $this->MODULE);
	}
}
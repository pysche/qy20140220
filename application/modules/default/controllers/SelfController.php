<?php

class SelfController extends Bc_Controller_Action_Panel {

	public function init() {
		parent::init();

		$this->nLogin();
	}
	
	public function modifypasswordAction() {
		
	}
	
	public function domodifypasswordAction() {
		$newPass = $this->getRequest()->getParam('new_password', '');
		$confirmPass = $this->getRequest()->getParam('confirm_password', '');
		
		if ($newPass=='' || $confirmPass=='') {
			$this->view->errormsg('请将新密码、确认密码填写完整');
		} else if ($newPass!=$confirmPass) {
			$this->view->errormsg('两次填写的密码不一致');
		} else {
			$m = &$this->M('users');
			$m->update(array(
				'Password' => md5($newPass)
			), $m->getAdapter()->quoteInto('id=?', $this->uid));
			
			$this->view->successmsg('密码修改成功');
		}
	}
}
<?php

require_once 'Zend/Controller/Action.php';

class Bc_Controller_Action_Base extends Zend_Controller_Action {
	protected $isAjax = false;
	protected $aName = '';
	protected $MODULE = '';
	protected $URL = '';
	protected $sess = null;
	protected $uid = 0;
	protected $config = null;

	public function init() {
		parent::init();
		
		Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer')->setViewSuffix('php');
		
		$this->view->isAjax = $this->isAjax = $this->getRequest()->isXmlHttpRequest();
		$this->view->cName = $this->_request->getControllerName();
		$this->view->ACTION = $this->aName = $this->_request->getActionName();
		
		$name = $this->_request->getControllerName ();
		$m = $this->_request->getModuleName();

		$this->URL = $this->view->URL = $m=='default' ? $name : $this->_request->getModuleName().'/'.$name;
		$this->MODULE = $this->view->MODULE = $this->_request->getModuleName();
		
		$this->params = $this->view->params = $this->getRequest()->getParams();
		
		$this->sess = &Bc_Session::i($this->MODULE);
		$this->uid = (int)$this->sess->get('uid');

		$this->view->config = $this->config = Bc_Config::appConfig();
	}

	protected function initSite() {

	}

	protected function &M($m='') {
		return Bc_Db::t($m ? $m : $this->_request->getControllerName());
	}

	protected function auth() {
		$pass = false;
		
		if ($this->uid>0) {
			$pass = true;
		}

		return $pass;	
	}

	protected function nLogin() {
		if (!$this->auth()) {
			$this->_helper->getHelper('Redirector')->gotoSimple('', 'login', $this->MODULE);
		}
	}
}
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
	protected $cName = '';
	protected $mName = '';
	protected $pager = array();
	protected $params = array();

	public function init() {
		parent::init();
		
		Zend_Controller_Action_HelperBroker::getStaticHelper('ViewRenderer')->setViewSuffix('php');
		
		$this->view->isAjax = $this->isAjax = $this->getRequest()->isXmlHttpRequest();
		$this->cName = $this->view->cName = $this->_request->getControllerName();
		$this->view->ACTION = $this->aName = $this->_request->getActionName();
		
		$m = $this->_request->getModuleName();

		$this->URL = $this->view->URL = $m=='default' ? $this->cName : $this->_request->getModuleName().'/'.$this->cName;
		$this->MODULE = $this->view->MODULE = $this->_request->getModuleName();
		
		$this->params = $this->view->params = $this->getRequest()->getParams();
		
		$this->sess = &Bc_Session::i('default');
		$this->uid = (int)$this->sess->get('uid');

		$this->view->config = $this->config = Bc_Config::appConfig();
		$this->view->CONFIG = $this->config->toArray();

		$this->pager_init();
		$this->view->pager = $this->pager;
	}

	protected function initSite() {

	}

	public function sp($key, $val) {
		$this->params[$key] = $val;
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
		if (!$this->uid) {
			$this->_helper->getHelper('Redirector')->gotoSimple('', 'login', 'default');
		}
	}
		
	protected function logit(array $params) {
		$this->M('logs')->insert(array(
			'CreateTime' => date('Y-m-d H:i:s'),
			'Uid' => $this->uid,
			'Ip' => Bc_Request::clientIp(),
			'Title' => $params['Title'],
			'Memo' => $params['Memo'] ? $params['Memo'] : '',
			'Content' => $params['Content'] ? $params['Content'] : '',
			'Actor' => $this->actor
			));
	}
	
	protected function pager_init($params=array()) {
		foreach ($params as $k=>$v) {
			$this->pager[$k] = $v;
		}
	
		$this->pager['page'] = $params['page'] ? (int)$params['page'] : (int)$this->getRequest()->getParam('pg', (int)$this->getRequest()->getParam('page', 1));
		$this->pager['limit'] = $params['limit'] ? (int)$params['limit'] : (int)$this->getRequest()->getParam('limit', (int)$this->getRequest()->getParam('rows', 10));
		$this->pager['skip'] = $params['skip'] ? (int)$params['skip'] : $this->pager['limit']*($this->pager['page']-1);
	}
}
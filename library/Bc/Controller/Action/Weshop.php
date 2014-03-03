<?php

class Bc_Controller_Action_Weshop extends Bc_Controller_Action_Base {
	protected $uid = 0;
	protected $siteId = 0;
	protected $user = array();
	protected $menu = array();
	protected $params = array();
	protected $site = array();
	protected $simple = false;
	protected $caches2update = array(
		'insert' => array(),
		'update' => array(),
		'delete' => array()
		);
	protected $vo = null;
	protected $searchKeys = array();
	protected $MName = '';
	protected $actor = '';
	protected $role = '';
	protected $restrictRole = 'admin';

	public function init() {
		parent::init();
		
		if ($this->uid>0) {
			$user = $this->M('users')->id($this->uid);
			if ($user) {
				$this->view->user = $this->user = $user->toArray();

				$this->actor = $this->user['Realname'];
				
				$this->role = $this->user['Role'];
				if ($this->restrictRole && $this->role!=$this->restrictRole) {
					$this->_helper->getHelper('Redirector')->setCode(301)->setExit(true)->gotoSimple('logout', 'login', 'default');
				}
			}
		}
		
		$this->view->return = $this->view->url(array(
			'module' => $this->MODULE,
			'controller' => $this->cName,
			'action' => 'index',
			), null, true);
	}

	protected function dbMap($dbCols = array()) {
		$dbMap = array();

		if (is_array($dbCols)) {
			foreach ($this->params as $key=>$val) {
				if (in_array($key, $dbCols, true)) {
					$dbMap[$key] = $val;
				}
			}
		}
		
		return $dbMap;
	}

	public function indexAction() {
		$this->auth('list');

		$model = &$this->M($this->mName);
		$dbMap = $this->dbMap($model->info('cols'));
		if (method_exists($this, '_filter')) {
			$this->_filter($dbMap);
		}
		
		$termCount = 0;
		foreach($dbMap as $key => $val) {
			if (isset($val) && trim($val) != '') {
				if (is_array($val) && trim($val [1] ) != '') {
					$where .= ($termCount > 0 ? ' AND ' : ' ') . $key . ' ' . $val [0] . ' \'' . trim ( $val [1] ) . '\'';
					$termCount ++;
				} else if (trim($val) != '') {
					$where .= ($termCount > 0 ? ' AND ' : ' ') . $key . ' LIKE \'%' . trim ( $val ) . '%\'';
					$termCount ++;
				}
					
			}
		}

		if ($this->params['search_key'] && $this->params['Keywords']) {
			$where .= ($where ? ' AND ' : '').$model->getAdapter()->quoteInto($this->params['search_key'].' LIKE ?', '%'.$this->params['Keywords'].'%');
		}

		if (!empty($this->params['orderField'])) {
			$order = $this->params['orderField'];
			if (empty($this->params['orderDirection'])) {
				$order .= ' ASC';
			} else {
				$order .= ' ' . $this->params['orderDirection'];
			}
		} else {
			$order = "id DESC";
		}
	
		$numPerPage = 10;
		$offset = 0;
		$pageNum = $this->params['page'];
		if (!empty($pageNum) && $pageNum>0) {
			$offset = ($pageNum - 1)*$numPerPage;
		}
	
		$where = $this->force_where ? ($where ? $where.' AND '.$this->force_where : $this->force_where) : $where;
		$where .= ($where ? ' AND ' : '').$model->getAdapter()->quoteInto('Deleted=?', 0);

		$totalCount = $model->getAdapter()->fetchOne('SELECT COUNT(*) AS COUNT FROM ' . $model->info('name') . (empty($where) ? '' : ' WHERE ' . $where));

		$this->view->list = $model->fetchAll( $where, $order, $numPerPage, $offset );
		$this->view->totalCount = $totalCount;
		$this->view->numPerPage = $numPerPage;
		$this->view->currentPage = $pageNum > 0 ? $pageNum : 1;
	}
	
	/**
	 * 数据展示页面
	 */
	public function readAction() {
		$this->editAction('list');
		
		$model = &$this->M($this->mName);
		$this->view->vo = $this->vo = $model->fetchRow('id=' . (int)$this->getRequest()->getParam('id').($this->force_where ? ' AND '.$this->force_where : ''));
	}
	
	/**
	 * 数据创建页面
	 */
	public function addAction() {
		$this->auth('add');
	}
	
	/**
	 * 数据编辑页面
	 */
	public function editAction($auth='update') {
		$auth!==null && $this->auth($auth);
	
		$model = &$this->M($this->mName);
		$this->view->vo = $this->vo = $model->fetchRow('id=' . (int)$this->getRequest()->getParam('id').($this->force_where ? ' AND '.$this->force_where : ''));
	}
	
	/**
	 * 创建数据操作
	 */
	public function insertAction() {
		$this->auth('add');
	
		try {
			$model = &$this->M($this->mName);
			$dbMap = $this->dbMap($model->info('cols'));
			$dbMap['Uid'] = $this->uid;
			$dbMap['CreateTime'] = date('Y-m-d H:i:s');
			
			$id = $model->insert($dbMap);
			$this->sess->set('file_hash');
			
			$this->afterInsert();
			
			$this->view->Successmsg('操作成功');
		} catch (Exception $e) {
			Bc_Log::i()->error($e->getMessage()."\n".$e->getTraceAsString());
			$this->view->Errormsg ('操作失败');
		}
	}
	
	/**
	 * 更新数据操作
	 */
	function updateAction() {
		$this->auth('update');
	
		try {
			$model = $this->M($this->mName);
			$dbMap = $this->dbMap( $model->info('cols'));
			$db = $model->getAdapter();
				
			$where = $db->quoteInto ('id=?', (int)$this->getRequest()->getParam('id')).($this->force_where ? ' AND '.$this->force_where : '');

			$row_affected = $model->update($dbMap, $where);
		
			$this->afterUpdate();
			
			$this->view->Successmsg('操作成功');
		} catch ( Exception $e ) {
			Bc_Log::i()->error($e);
			$this->view->Errormsg('操作失败');
		}
	}
	
	/**
	 * 删除数据操作，设置删除标志
	 */
	public function deleteAction() {
		$this->auth('delete');

		try {
			$model = $this->M($this->mName);
			$db = $model->getAdapter();

			$row = $model->fetchRow('id=' . (int)$this->getRequest()->getParam('id'));
			
			if ($row) {
				$where = $db->quoteInto('id=?', (int)$this->getRequest()->getParam('id')).($this->force_where ? ' AND '.$this->force_where : '');

				$row_affected = $model->update(array('Deleted' => 1), $where);
			}
			
			$this->afterDelete();
			
			$this->view->Successmsg("操作成功");
		} catch ( Exception $e ) {
			Bc_Log::i()->error($e);
			$this->view->Errormsg ('操作失败');
		}
	}
	
	/**
	 * 强制删除数据操作
	 */
	public function foreverdeleteAction() {
		$this->auth('delete');
	
		try {
			$model = $this->M($this->mName);
			$db = $model->getAdapter();
			$where = $db->quoteInto('id=?', (int)$this->getRequest()->getParam('id'));
			$row_affected = $model->delete($where);
			$this->success ( "操作成功" );
		} catch ( Exception $e ) {
			$this->error ( '操作失败' );
		}
	}
	
	protected function afterInsert() {
		
	}
	
	protected function afterUpdate() {
		
	}
	
	protected function afterDelete() {
		
	}
	
}
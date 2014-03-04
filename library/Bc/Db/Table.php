<?php

abstract class Bc_Db_Table extends Zend_Db_Table {
	
	public function __call($method, $params) {
		$data = false;
		
		if (preg_match('/^([a-zA-Z0-9_]+)$/is', $method)) {
			$db = &$this->getAdapter();
			$where = $db->quoteInto('`'.$method.'`=?', $params[0]);
			
			$data = $this->fetchRow($where, null);
		}
		
		return $data;
	}
	
	public function __construct() {
		$prefix = Bc_Config::getInstance()->resources->db->params->tbl_prefix;		
		$this->_name = $prefix.ucfirst(str_replace('Bc_Db_Table_', '', get_class($this)));		

		parent::__construct();
	}

	public function ids(array $ids) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('id IN (?)', $ids);
		$where .= ' AND '.$db->quoteInto('Deleted=?', 0);
		
		return $this->fetchAll($where, null);
	}
	
	public function findById($id) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('`id`=?', $id);

		return $this->fetchRow($where, null);
	}

	public function findByIds(array $ids) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('`id` IN (?)', $ids);

		return $this->fetchAll($where, null);
	}

	public function doDelete($id) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('id=?', $id);

		return $this->delete($where);
	}
	
	public function count($where='') {
		return $this->getAdapter()->fetchOne('SELECT COUNT(*) AS `count` FROM `'.$this->_name.'` '.($where ? 'WHERE '.$where : ''));
	}
	
	public function search(array $params) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		
	}

	public function getName() {
		return $this->_name;
	}

	public function startTrans() {
		$this->getAdapter()->query('START TRANSACTION');
	}

	public function commitTrans() {
		$this->getAdapter()->query('COMMIT');
	}

	public function rollbackTrans() {
		$this->getAdapter()->query('ROLLBACK');
	}
	
}
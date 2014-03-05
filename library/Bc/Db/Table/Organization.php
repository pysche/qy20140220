<?php

class Bc_Db_Table_Organization extends Bc_Db_Table {
	
	public function &buyer($name) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('Name=?', $name);
		$select->where('Type=?', 'buyer');
		$select->limitPage(1, 1);

		return $db->fetchRow($select);
	}

	public function &trans($name) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('Name=?', $name);
		$select->where('Type=?', 'trans');
		$select->limitPage(1, 1);

		return $db->fetchRow($select);
	}

	public function &seller($name) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('Name=?', $name);
		$select->where('Type=?', 'seller');
		$select->limitPage(1, 1);

		return $db->fetchRow($select);
	}

	public function simpleAll() {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('Deleted=?', '0');
		$select->where('Status=?', '1');
		$select->order('Name ASC');

		return $db->fetchAll($select);
	}

	public function insert($params) {
		$result = parent::insert($params);
		$cacher = Bc_Cache_Remote::getInstance();
		$cacher->set('uorgs');

		return $result;
	}

	public function update($params, $where) {
		$result = parent::update($params, $where);
		$cacher = Bc_Cache_Remote::getInstance();
		$cacher->set('uorgs');

		return $result;
	}
}
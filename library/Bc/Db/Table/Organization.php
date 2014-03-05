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
}
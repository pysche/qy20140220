<?php

class Bc_Db_Table_Users extends Bc_Db_Table {
	public function insert($params) {
		$params['Password'] = md5($params['Password']);
		
		return parent::insert($params);
	}

	public function update($params, $where=null) {
		if (isset($params['Password'])) {
			$params['Password'] = md5($params['Password']);	
		}
		
		return parent::update($params, $where);
	}
	
	public function exists($username, $userid=0) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('id!=?', $userid);
		$select->where('Username=?', $username);
		$select->where('Deleted=?', 0);
		$select->limitPage(1, 1);
		
		$row = $db->fetchRow($select);
		
		return $row ? true : false;
	}

}
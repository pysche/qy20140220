<?php

class Bc_Db_Table_Regions extends Bc_Db_Table {
	
	public function insert($params) {
		$params['CreateTime'] = date('Y-m-d H:i:s');
		
		return parent::insert($params);
	}

	public function simpleAll() {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->order('Sort ASC');
		
		$rows = $db->fetchAll($select);
		
		return $rows ? $rows : array();
	}
	
	public function subs($id) {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('ParentId=?', $id);
		$select->order('Sort ASC');
		
		$rows = $db->fetchAll($select);
		
		return $rows ? $rows : array();
	}
}
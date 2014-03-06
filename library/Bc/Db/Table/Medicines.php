<?php

class Bc_Db_Table_Medicines extends Bc_Db_Table {
	
	public function &search(array $params) {
		$rows = array();
		$db = &$this->getAdapter();
		$tDirectories = &Bc_Db::t('directories');
		$tOrg = &Bc_Db::t('Organization');
		
		$dJoin = 'd.medicine_id=m.id';

		$select = &$db->select();
		$select->from($this->_name.' AS m');
		if ($params['org_id']) {
			$dJoin .= ' AND '.$db->quoteInto('d.org_id=?', $params['org_id']);
			$select->joinleft($tDirectories->getName().' AS d', $dJoin, array(
				new Zend_Db_Expr('d.id AS `Choosed`')
			));
		}
		
		$params['where'] && $select->where($params['where']);
		$params['order'] && $select->order($params['order']);
		
		$select->limitPage($params['page'], $params['limit']);
		
		$rows = $db->fetchAll($select);
		
		return $rows;
	}
	
	public function &cnt(array $params) {
		$rows = array();
		$db = &$this->getAdapter();
		$tDirectories = &Bc_Db::t('directories');
		$tOrg = &Bc_Db::t('Organization');
		
		$dJoin = 'd.medicine_id=m.id';
		
		$select = &$db->select();
		$select->from($this->_name.' AS m', 'COUNT(*) AS Total');
		if ($params['org_id']) {
			$dJoin .= ' AND '.$db->quoteInto('d.org_id=?', $params['org_id']);
			$select->joinleft($tDirectories->getName().' AS d', $dJoin, array());	
		}
		
		$params['where'] && $select->where($params['where']);
		
		$row = $db->fetchRow($select);
		
		return (int)$row['Total'];
	}
}
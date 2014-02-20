<?php

class Bc_Db_Table_Goods extends Bc_Db_Table {

	public function &areas($cid, $siteId=0) {
		$db = &$this->getAdapter();

		$select = &$db->select();
		$select->from($this->_name);
		$select->where('AreaId=?', $cid);
		$select->where('Deleted=?', '0');
		$select->where('Status=?', '1');

		if ($siteId) {
			$select->where('SiteId=?', (int)$siteId);
		}

		$select->order('id DESC');

		return $db->fetchAll($select);
	}

}
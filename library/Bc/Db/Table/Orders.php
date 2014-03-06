<?php

class Bc_Db_Table_Orders extends Bc_Db_Table {
	public function insert($params) {
		$params['CreateTime'] = date('Y-m-d H:i:s');
		$params['Deleted'] = 0;
		$params['Code'] = $this->nCode();

		return parent::insert($params);
	}

	public function nCode() {
		$db = &$this->getAdapter();
		$select = &$db->select();
		$select->from($this->_name);
		$select->where('CreateTime>?', date('Y-m-d 00:00:00'));
		$select->order('CreateTime DESC');
		$select->limitPage(1, 1);

		$row = $db->fetchRow($select);
		$code = 'YZ'.date('Ymd');

		if ($row) {
			$suffix = intval(substr($row['Code'], -4))+1;
			$code .= str_repeat('0', 4-strlen($suffix)).$suffix;
		} else {
			$code .= '0001';
		}

		return $code;
	}

}
<?php

class Bc_Db_Table_Weixinorder extends Bc_Db_Table {

	public function newsn() {
		$sn = date('md').rand(1000, 9999);
		$db = &$this->getAdapter();
		$select = &$db->select();

		$select->from($this->_name);
		$select->where('OrderSn=?', $sn);
		$select->limitPage(1, 1);

		$row = $db->fetchRow($select);

		if ($row) {
			$sn = $this->newsn();
		}

		return $sn;
	}

}
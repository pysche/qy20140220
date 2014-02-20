<?php

class Bc_Db_Table_Attachment extends Bc_Db_Table {
	public function insert($params) {
		$params['CreateTime'] = date('Y-m-d H:i:s');
		
		return parent::insert($params);
	}

	public function saveOrder($id, $order) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('id=?', $id);

		return $this->update(array(
			'OrderNo' => $order
			), $where);
	}

	public function getByHash($hash) {
		$db = &$this->getAdapter();
		$where = $db->quoteInto('Hash=?', $hash);

		return $this->fetchAll($where, 'OrderNo ASC')->toArray();
	}
}
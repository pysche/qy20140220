<?php

class Bc_Db_Table_Directories extends Bc_Db_Table {
	
	public function save($buyerId, $medicineId) {
		$db = &$this->getAdapter();
		$sql = "REPLACE INTO `".$this->_name."` (`org_id`, `medicine_id`) VALUE ('".intval($buyerId)."', '".intval($medicineId)."')";

		return $db->query($sql);
	}
}
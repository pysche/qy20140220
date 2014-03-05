<?php

class Bc_Db_Table_Directories extends Bc_Db_Table {
	
	public function save($buyerId, $medicineId) {
		$db = &$this->getAdapter();
		$sql = "REPLACE INTO `".$this->_name."` (`org_id`, `medicine_id`) VALUE ('".intval($buyerId)."', '".intval($medicineId)."')";

		return $db->query($sql);
	}

	public function &search(array $params) {
		$result = array(
			'rows' => array(),
			'pages' => 0,
			'count' => 0
			);
	
		$pager = $params['pager'];
		$page = (int)$pager['page'];
		$limit = (int)$pager['limit'];
		$Name = trim($params['name']);
		$keywords = trim($params['keywords']);
		$key = trim($params['key']);
	
		$db = &$this->getAdapter();
		$tMedicines = &Bc_Db::t('medicines');
	
		$select = &$db->select();

		if (strlen($Name)) {
			$select->where('m.Name LIKE ?', '%'.$Name.'%');
		}

		if (strlen($key) && strlen($keywords)) {
			$where = trim($db->quoteInto('?', $key), "'").$db->quoteInto(' LIKE ?', '%'.$keywords.'%');
			$select->where($where);
		}
	
		$order = ' m.CreateTime DESC';
	
		$cselect = clone $select;
		$cselect->from($this->_name.' AS d', array(
			new Zend_Db_Expr('COUNT(*) AS total')
			));
		$cselect->join($tMedicines->getName().' AS m', 'm.id=d.medicine_id AND m.Deleted=0', array());
	
		$row = $db->fetchRow($cselect);
		$total = $row ? (int)$row['total'] : 0;
		$pages = Bc_Funcs::pages($total, $limit);
	
		if ($total>0) {
			$select->from($this->_name.' AS d', array());
			$select->join($tMedicines->getName().' AS m', 'm.id=d.medicine_id AND m.Deleted=0', array(
				'm.*'
				));
			$select->order($order);
	
			$select->limitPage($page, $limit);
			$rows = $db->fetchAll($select);
	
			$result['rows'] = &$rows;
		}
	
		$result['pages'] = $pages;
		$result['count'] = $total;
	
		return $result;
	}
}
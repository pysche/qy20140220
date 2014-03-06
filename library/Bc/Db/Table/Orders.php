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

	public function &search(array $params) {
		$result = array(
			'rows' => array(),
			'pages' => 0,
			'count' => 0
			);

		$pager = $params['pager'];
		$page = (int)$pager['page'];
		$limit = (int)$pager['limit'];
		$uid = $params['uid'];
		$status = $params['status'];
		$searchKey = $params['search_key'];
		$Keywords = $params['Keywords'];
		$startDate = $params['start_date'];
		$endDate = $params['end_date'];
		$code = $params['code'];
		$transId = $params['trans_id'];
		
		$tUser = &Bc_Db::t('users');
		$tOrg = &Bc_Db::t('organization');
		$tMedicine = &Bc_Db::t('medicines');
		$db = &$this->getAdapter();
		$select = &$db->select();
		
		if ($uid) {
			$select->where('o.Uid=?', $uid);
		}

		if ($transId) {
			$select->where('o.TransId=?', $transId);
		}
		
		if (strlen($startDate)) {
			try {
				$sdt = new DateTime($startDate);
				$select->where('o.CreateTime>=?', date('Y-m-d 00:00:00', $sdt->getTimestamp()));
			} catch (Exception $e) {}
		}

		if (strlen($endDate)) {
			try {
				$edt = new DateTime($endDate);
				$select->where('o.CreateTime<?', date('Y-m-d 23:59:59', $edt->getTimestamp()));
			} catch (Exception $e) {}
		}

		if (strlen($code)) {
			$select->where('o.Code LIKE ?', '%'.$word.'%');
		}
		
		if ($status) {
			if (is_array($status)) {
				$select->where('o.status IN (?)', $status);
			} else {
				$select->where('o.status=?', $status);
			}
		}

		$cselect = clone $select;
		$cselect->join($tMedicine->getName().' AS m', 'm.id=o.MedicineId', array());
		$cselect->join($tOrg->getName().' AS trans', 'trans.id=o.TransId AND trans.Type=\'trans\'', array());
		$cselect->join($tUser->getName().' AS u', 'u.id=o.Uid', array());
		$cselect->join($tOrg->getName().' AS buyer', 'buyer.id=u.OrgId AND buyer.Type=\'buyer\'', array());
				
		$cselect->from($this->_name.' AS o', array(
			new Zend_Db_Expr('COUNT(*) AS total')
			));
		$row = $db->fetchRow($cselect);
		$total = $row ? (int)$row['total'] : 0;
		$pages = Bc_Funcs::pages($total, $limit);

		if ($total>0) {
			$select->from($this->_name.' AS o');
			$select->join($tMedicine->getName().' AS m', 'm.id=o.MedicineId', array(
				new Zend_Db_Expr('m.Name AS MedicineName')
				));
			$select->join($tOrg->getName().' AS trans', 'trans.id=o.TransId AND trans.Type=\'trans\'', array(
				new Zend_Db_Expr('trans.Name AS TransName')
				));
			$select->join($tUser->getName().' AS u', 'u.id=o.Uid', array());
			$select->join($tOrg->getName().' AS buyer', 'buyer.id=u.OrgId AND buyer.Type=\'buyer\'', array(
				new Zend_Db_Expr('buyer.Name AS BuyerName')
				));
					
			$select->order('o.CreateTime DESC');

			$select->limitPage($page, $limit);
			$rows = $db->fetchAll($select);
		
			$result['rows'] = &$rows;
		}
		
		$result['pages'] = $pages;
		$result['count'] = $total;
		
		return $result;		
	}

}
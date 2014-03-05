<?php

class MedicinesController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Name' => '名称',
			'NormalName' => '通用名'
			);

		$this->view->MName = $this->MName = '药品目录';
	}

	public function importAction() {

	}

	public function doimportAction() {
		$file = &$_FILES['File'];
		if ($file) {
			try {
				$tmpName = $file['tmp_name'];
				include 'Vendor/PHPExcel.php';
				$reader = PHPExcel_IOFactory::createReader('Excel2007');
				$reader->setReadDataOnly(true);
				$excel = $reader->load($tmpName);
				$sheet = $excel->getActiveSheet();

				$tDirectories = &Bc_Db::t('directories');
				$tMedicines = &Bc_Db::t('medicines');
				$tOrg = &Bc_Db::t('organization');
				$range = range('A', 'M');
				$rows = $sheet->getHighestRow();

				for ($i=2;$i<=$rows;$i++) {
					$Name = trim($sheet->getCell('A'.$i)->getValue());
					$ProdName = trim($sheet->getCell('B'.$i)->getValue());
					$DosageForm = trim($sheet->getCell('C'.$i)->getValue());
					$Spec = trim($sheet->getCell('D'.$i)->getValue());
					$Unit = trim($sheet->getCell('E'.$i)->getValue());
					$ImportPrice = trim($sheet->getCell('G'.$i)->getValue());
					$Usage = trim($sheet->getCell('H'.$i)->getValue());
					$IsBasic = trim($sheet->getCell('K'.$i)->getValue());
					$IsLevel2Basic = trim($sheet->getCell('L'.$i)->getValue());

					$Trans = trim($sheet->getCell('I'.$i)->getValue());
					$Factory = trim($sheet->getCell('F'.$i)->getValue());
					
					$dFactory = $tOrg->seller($Factory);
					if (!$dFactory) {
						$SellerId = $tOrg->insert(array(
							'Name' => $Factory,
							'Type' => 'seller',
							'CreateTime' => date('Y-m-d H:i:s'),
							'Deleted' => 0,
							'Uid' => $this->uid,
							'Status' => 1
							));
					} else {
						$SellerId = $dFactory['id'];
					}

					$dTrans = $tOrg->trans($Trans);
					if (!$dTrans) {
						$TransId = $tOrg->insert(array(
							'Name' => $Factory,
							'Type' => 'trans',
							'CreateTime' => date('Y-m-d H:i:s'),
							'Deleted' => 0,
							'Uid' => $this->uid,
							'Status' => 1
							));
					} else {
						$TransId = $dTrans['id'];
					}

					$medicineId = $tMedicines->insert(array(
						'Name' => $Name,
						'ProdName' => $ProdName,
						'DosageForm' => $DosageForm,
						'Spec' => $Spec,
						'Unit' => $Unit,
						'ImportPrice' => $ImportPrice,
						'Usage' => $Usage,
						'IsBasic' => $IsBasic,
						'IsLevel2Basic' => $IsLevel2Basic
						));

					$tDirectories->save($TransId, $medicineId);
					$tDirectories->save($SellerId, $medicineId);
				}

				$this->logit(array(
					'Title' => '导入药品基础数据',
					'Content' => '共 '.$rows.' 条数据'
				));
				$this->view->Successmsg('操作成功');
			} catch (Exception $e) {
				echo '<H1>'.$e->getMessage().'</h1>';
				echo $e->getTraceAsString();exit;
				$this->view->Errormsg('导入失败: '.$e->getMessage());
			}
		}
	}

	public function indexAction() {
		$this->auth('list');
		
		$model = &$this->M($this->mName ? $this->mName : strtolower(str_replace('Controller', '', __CLASS__)));
		$dbMap = $this->dbMap($model->info('cols'));
		if (method_exists($this, '_filter')) {
			$this->_filter($dbMap);
		}
		
		$termCount = 0;
		foreach($dbMap as $key => $val) {
			if (isset($val) && trim($val) != '') {
				if (is_array($val) && trim($val [1] ) != '') {
					$where .= ($termCount > 0 ? ' AND ' : ' ') . $key . ' ' . $val [0] . ' \'' . trim ( $val [1] ) . '\'';
					$termCount ++;
				} else if (trim($val) != '') {
					$where .= ($termCount > 0 ? ' AND ' : ' ') . $key . ' LIKE \'%' . trim ( $val ) . '%\'';
					$termCount ++;
				}
					
			}
		}
		
		if ($this->params['search_key'] && $this->params['Keywords']) {
			$where .= ($where ? ' AND ' : '').$model->getAdapter()->quoteInto($this->params['search_key'].' LIKE ?', '%'.$this->params['Keywords'].'%');
		}
		
		if (!empty($this->params['orderField'])) {
			$order = $this->params['orderField'];
			if (empty($this->params['orderDirection'])) {
				$order .= ' ASC';
			} else {
				$order .= ' ' . $this->params['orderDirection'];
			}
		} else {
			$order = "m.id DESC";
		}
		
		$numPerPage = $this->params['limit'] ? (int)$this->params['limit'] : 10;
		$offset = 0;
		$pageNum = $this->params['page'];
		if (!empty($pageNum) && $pageNum>0) {
			$offset = ($pageNum - 1)*$numPerPage;
		}
		
		$where = $this->force_where ? ($where ? $where.' AND '.$this->force_where : $this->force_where) : $where;
		$where .= ($where ? ' AND ' : '').$model->getAdapter()->quoteInto('m.Deleted=?', 0);
		
		$totalCount = $model->cnt(array(
			'where' => $where,
			'org_id' => $this->params['OrgId']
		));
		
		$this->view->list = $model->search(array(
			'where' => $where,
			'order' => $order,
			'page' => $pageNum ? $pageNum : 1,
			'limit' => $numPerPage,
			'org_id' => $this->params['OrgId']
		));
		$this->view->totalCount = $totalCount;
		$this->view->numPerPage = $numPerPage;
		$this->view->currentPage = $pageNum > 0 ? $pageNum : 1;		
	}

	public function addAction() {

	}
	
}
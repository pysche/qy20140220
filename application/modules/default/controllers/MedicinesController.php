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
			header('Content-Type: text/html; charset=utf-8');
			$tmpName = $file['tmp_name'];
			$c = iconv('gbk', 'utf8', file_get_contents($tmpName));
			$lines = explode("\n\r", $c);

			foreach ($lines as $line) {
				echo $line.'<HR>';
			}
			var_dump($lines);exit;
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
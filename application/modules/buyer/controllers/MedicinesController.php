<?php

class Buyer_MedicinesController extends Bc_Controller_Action_Buyer {

	public function init() {
		parent::init();
		
		$this->nLogin();

		$this->mName = 'medicines';

		$this->view->searchKeys = $this->searchKeys = array(
			'`m`.`Name`' => '药品名',
			'm.ProdName' => '通用名'
			);

		$this->view->MName = $this->MName = '药品目录浏览';
	}

	public function indexAction() {
		$keywords = trim(urldecode($this->getRequest()->getParam('Keywords', '')));
		$searchKey = trim(urldecode($this->getRequest()->getParam('search_key', '')));

		$tDirectories = &Bc_Db::t('directories');
		$data = $tDirectories->search(array(
			'pager' => $this->pager,
			'keywords' => $keywords,
			'key' => $searchKey,
			'org_id' => $this->user['OrgId']
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}

	public function tocartAction() {
		$this->editAction();

		$this->view->transArr = Bc_Db::t('directories')->trans($this->view->vo->id);
	}

	public function savecartAction() {
		$id = (int)$this->getRequest()->getParam('id', 0);
		$nums = (int)$this->getRequest()->getParam('nums', 0);
		$transId = (int)$this->getRequest()->getParam('trans_id', 0);
		$memo = trim(urldecode($this->getRequest()->getParam('memo', '')));
		$output = array();

		if ($id && $nums && $transId) {
			$tMedicine = &Bc_Db::t('medicines');
			$tOrder = &Bc_Db::t('orders');

			$med = $tMedicine->id($id);
			$total = $nums*$med['ImportPrice'];

			$oid = $tOrder->insert(array(
				'Uid' => $this->uid,
				'Nums' => $nums,
				'TransId' => $transId,
				'MedicineId' => $id,
				'Memo' => $memo,
				'Total' => $total
				));

			$output['id'] = $oid;
		}

		$this->json($output);
	}
}
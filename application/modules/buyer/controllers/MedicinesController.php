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
		$this->pager_init();
		$keywords = trim(urldecode($this->getRequest()->getParam('Keywords', '')));
		$searchKey = trim(urldecode($this->getRequest()->getParam('search_key', '')));

		$tDirectories = &Bc_Db::t('directories');
		$data = $tDirectories->search(array(
			'pager' => $this->pager,
			'keywords' => $keywords,
			'key' => $searchKey
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}
}
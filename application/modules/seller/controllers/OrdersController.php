<?php

class Seller_OrdersController extends Bc_Controller_Action_Seller {

	public function init() {
		$this->force_where = 'Uid='.$this->uid;
		$this->mName = 'Orders';

		parent::init();
		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '订单号',
			);

		$this->view->MName = $this->MName = '订单浏览';
	}

	public function indexAction() {
		$keywords = trim(urldecode($this->getRequest()->getParam('Keywords', '')));
		$searchKey = trim(urldecode($this->getRequest()->getParam('search_key', '')));

		$tOrders = &Bc_Db::t('orders');
		$data = $tOrders->search(array(
			'pager' => $this->pager,
			'keywords' => $keywords,
			'key' => $searchKey,
			'trans_id' => $this->user['OrgId']
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}
}
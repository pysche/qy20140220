<?php

class Manage_OrdersController extends Bc_Controller_Action_Manage {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '订单编号',
			'Buyer' => '买方机构',
			'Seller' => '卖方机构',
			'Trans' => '配送企业'
			);

		$this->view->MName = $this->MName = '订单查看';
	}

	public function indexAction() {
		$keywords = trim(urldecode($this->getRequest()->getParam('Keywords', '')));
		$searchKey = trim(urldecode($this->getRequest()->getParam('search_key', '')));

		$tOrders = &Bc_Db::t('orders');
		$data = $tOrders->search(array(
			'pager' => $this->pager,
			'keywords' => $keywords,
			'key' => $searchKey,
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}
	
	public function showAction() {
		$this->readAction();

		$buser = &Bc_Db::t('users')->id($this->vo->Uid);

		$this->view->medicine = Bc_Db::t('medicines')->id($this->vo->MedicineId);
		$this->view->trans = Bc_Db::t('organization')->obyid($this->vo->TransId, 'trans');
		$this->view->buyer = Bc_Db::t('organization')->obyid($buser['OrgId'], 'buyer');
	}

}
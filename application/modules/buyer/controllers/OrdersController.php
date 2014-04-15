<?php

class Buyer_OrdersController extends Bc_Controller_Action_Buyer {

	public function init() {
		$this->mName = 'Orders';

		parent::init();
		$this->nLogin();

		$this->force_where = 'Uid='.$this->uid;
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
			'uid' => $this->uid
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}

	public function showAction() {
		$this->readAction();

		$this->view->canCancel = $this->orderCanCancel($this->vo);
		$this->view->medicine = Bc_Db::t('medicines')->id($this->vo->MedicineId);
		$this->view->trans = Bc_Db::t('organization')->obyid($this->vo->TransId, 'trans');
	}

	public function cancelAction() {
		$this->readAction();

		$ok = $this->M($this->mName)->cancel($this->vo->id, $this->uid);
		if ($ok) {
			Bc_Db::t('orderslog')->insert(array(
				'OrderId' => $this->vo->id,
				'CreateTime' => date('Y-m-d H:i:s'),
				'Uid' => $this->uid,
				'FromStatus' => $this->vo->Status,
				'ToStatus' => $this->config->order->status->canceled,
				'OrgName' => $this->_org['Name']
				));
		}
	}
}
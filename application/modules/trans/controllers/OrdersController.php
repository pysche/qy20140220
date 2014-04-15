<?php

class Trans_OrdersController extends Bc_Controller_Action_Trans {

	public function init() {
		$this->mName = 'Orders';

		parent::init();
		$this->nLogin();

		$this->force_where = 'TransId='.intval($this->user['OrgId']);
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '订单号',
			);

		$this->view->MName = $this->MName = '订单浏览';
	}

	public function sentAction() {
		if ($this->params['Status']) {
			$this->params['Status'] = (array)$this->params['Status'];
		} else {
			$this->params['Status'] = array();
		}

		$this->params['Status'][] = $this->config->order->status->sent;

		$this->indexAction();
		echo $this->view->render('orders/index.php');
		exit(0);
	}

	public function paidAction() {
		if ($this->params['Status']) {
			$this->params['Status'] = (array)$this->params['Status'];
		} else {
			$this->params['Status'] = array();
		}

		$this->params['Status'][] = $this->config->order->status->paid;

		$this->indexAction();
		echo $this->view->render('orders/index.php');
		exit(0);
	}

	public function canceledAction() {
		if ($this->params['Status']) {
			$this->params['Status'] = (array)$this->params['Status'];
		} else {
			$this->params['Status'] = array();
		}

		$this->params['Status'][] = $this->config->order->status->canceled;

		$this->indexAction();
		echo $this->view->render('orders/index.php');
		exit(0);
	}

	public function pendingAction() {
		if ($this->params['Status']) {
			$this->params['Status'] = (array)$this->params['Status'];
		} else {
			$this->params['Status'] = array();
		}

		$this->params['Status'][] = $this->config->order->status->unact;
		$this->params['Status'][] = $this->config->order->status->prepare;

		$this->indexAction();
		echo $this->view->render('orders/index.php');
		exit(0);
	}

	public function indexAction() {
		$keywords = trim(urldecode($this->getRequest()->getParam('Keywords', '')));
		$searchKey = trim(urldecode($this->getRequest()->getParam('search_key', '')));

		$tOrders = &Bc_Db::t('orders');
		$data = $tOrders->search(array(
			'pager' => $this->pager,
			'keywords' => $keywords,
			'key' => $searchKey,
			'trans_id' => $this->user['OrgId'],
			'status' => $this->params['Status']
			));

		$this->view->pager = $this->pager;
		$this->view->list = $data['rows'];
		$this->view->pages = $data['pages'];
		$this->view->count = $data['count'];
	}

	public function showAction() {
		$this->readAction();

		$buser = &Bc_Db::t('users')->id($this->vo->Uid);

		$this->view->canCancel = $this->orderCanCancel($this->vo);
		$this->view->medicine = Bc_Db::t('medicines')->id($this->vo->MedicineId);
		$this->view->trans = Bc_Db::t('organization')->obyid($this->vo->TransId, 'trans');
		$this->view->buyer = Bc_Db::t('organization')->obyid($buser['OrgId'], 'buyer');
	}

	public function sprepareAction() {
		$this->readAction();

		$ok = $this->M($this->mName)->prepare($this->vo->id, $this->user['OrgId']);
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

	public function ssentAction() {
		$this->readAction();

		$ok = $this->M($this->mName)->sent($this->vo->id, $this->user['OrgId']);
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
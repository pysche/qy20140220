<?php

class Manage_MedicinesController extends Bc_Controller_Action_Manage {
	
	public function init() {
		$this->mName = 'medicines';
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Name' => '名称',
			'NormalName' => '通用名'
			);

		$this->view->MName = $this->MName = '药品目录';
	}

	public function settransAction() {
		$this->view->orgs = $this->_orgsArr();
	}

	public function dosettransAction() {
		$choosed = explode(',', $_POST['choosed']);
		$transId = (int)$_POST['trans_id'];
		$tMedicines = &Bc_Db::t('medicines');
		$tDirectories = &Bc_Db::t('directories');

		if ($choosed) {
			foreach ($choosed as $id) {
				$tDirectories->save($transId, $id);
				$tMedicines->save($id, array(
					'DefaultTrans' => $transId
					));
			}
		}

		$this->json();
	}

	public function addAction() {
		$this->view->orgs = $this->_orgsArr();
		parent::addAction();
	}

	public function editAction() {
		$this->view->orgs = $this->_orgsArr();
		parent::editAction();
	}
	
}
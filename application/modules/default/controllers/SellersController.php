<?php

class SellersController extends Bc_Controller_Action_Weshop {
	
	protected $level = null;
	
	public function init() {
		$this->force_where = 'Type=\'seller\'';
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '机构代码',
			'Name' => '机构名称',
			);

		$this->view->MName = $this->MName = '经销机构管理';
		
		$this->level = new Bc_Level(array(
			'id_key' => 'id',
			'name_key' => 'Name',
			'sort_key' => 'Sort',
			'parent_key' => 'ParentId',
			'tbl' => 'regions'
		));
		$this->view->levels = Bc_Funcs::array_merge(array('0' => '* 请选择 *'), $this->level->levelSelect);
	}

	public function insertAction() {
		$this->params['Type'] = $_REQUEST['Type'] = 'seller';
		
		parent::insertAction();
	}

	public function setmedicinesAction() {
		$data = array();

		$ids = (array)$_POST;
		$id = (int)$this->getRequest()->getParam('id');
		if ($id && count($ids)>0) {
			$dao = $this->M('directories');
			foreach ($ids as $mid) {
				$dao->save($id, $mid);
			}
		}

		$json = json_encode($data);
		die($json);
	}
	
	public function medicinesAction() {
		include_once dirname(__FILE__).'/MedicinesController.php';
		
		$obj = new MedicinesController($this->getRequest(), $this->getResponse());
		$obj->init();
		$obj->sp('Status', 1);
		$obj->sp('OrgId', $this->params['seller_id']);
		$obj->view = &$this->view;
		$obj->indexAction();
	}
}
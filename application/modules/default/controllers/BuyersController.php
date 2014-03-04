<?php

class BuyersController extends Bc_Controller_Action_Weshop {
	
	protected $level = null;
	
	public function init() {
		$this->force_where = 'Type=\'buy\'';
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '机构代码',
			'Name' => '机构名称',
			);

		$this->view->MName = $this->MName = '买方机构维护';
		
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
		$_REQUEST['Type'] = 'buy';
		
		parent::insertAction();
	}
	
	public function medicinesAction() {
		include_once dirname(__FILE__).'/MedicinesController.php';
		$_REQUEST['Status'] = 1;
		$obj = new MedicinesController($this->getRequest(), $this->getResponse());
		$obj->init();
		$obj->view = &$this->view;
		$obj->indexAction();
	}
}
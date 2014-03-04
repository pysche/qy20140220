<?php

class OrgsController extends Bc_Controller_Action_Weshop {

	protected $level = null;
	
	public function init() {
		$this->force_where = 'Type=\'org\'';
		$this->mName = 'Organization';

		parent::init();

		$this->nLogin();

		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '单位代码',
			'Name' => '单位名称',
			);

		$this->view->MName = $this->MName = '监管机构维护';
		
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
		$_REQUEST['Type'] = 'org';
		
		parent::insertAction();
	}
}
<?php

class RegionsController extends Bc_Controller_Action_Weshop {
	
	protected $level = null;
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Name' => '地区名称',
			);

		$this->view->MName = $this->MName = '地区管理';
		
		$this->level = new Bc_Level(array(
			'id_key' => 'id',
			'name_key' => 'Name',
			'sort_key' => 'Sort',
			'parent_key' => 'ParentId',
			'tbl' => 'regions'
		));
		
		$this->view->levels = Bc_Funcs::array_merge(array('0' => '* 请选择 *'), $this->level->levelSelect);
		
		$this->params['ParentId'] = (int)$this->params['ParentId'];
		$this->view->ParentId = (int)$this->getRequest()->getParam('ParentId', 0);
	}

	public function indexAction() {
		if ($this->view->ParentId) {
			$this->level->getParent($this->view->ParentId, true);
			
			$this->view->fids = $this->level->fids;
		}
		
		parent::indexAction();
	}
	
	public function insertAction() {
		$this->view->return = $this->view->url(array(
			'ParentId' => $this->view->ParentId
		));
		
		parent::insertAction();
	}
	
	public function updateAction() {
		$this->view->return = $this->view->url(array(
				'ParentId' => $this->view->ParentId
		));
		
		parent::updateAction();
	}
	protected function afterInsert() {
		$this->level->rebuildCache();
	}
	
	protected function afterUpdate() {
		$this->level->rebuildCache();
	}
	
	protected function afterDelete() {
		$this->level->rebuildCache();
	}
	
}
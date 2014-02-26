<?php

class ProjectsController extends Bc_Controller_Action_Weshop {
	
	public function init() {
		parent::init();

		$this->nLogin();
		$this->view->searchKeys = $this->searchKeys = array(
			'Code' => '项目编码',
			'Name' => '项目名称',
			);

		$this->view->MName = $this->MName = '项目管理';
	}

}
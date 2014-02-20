<?php

class Bc_Controller_Action_Front extends Bc_Controller_Action_Base {
	protected $uid = 0;
	protected $siteId = 0;
	protected $user = array();
	protected $menu = array();
	protected $params = array();
	protected $site = array();

	public function init() {
		parent::init();

		$this->initSite();
	}
}
<?php

class Bc_Weixin_Message_Handler_Event extends Bc_Weixin_Message_Handler_Base {
	protected $type = 'event';
	
	public function __construct($msg) {
		parent::__construct($msg);
	}

	public function process() {
		switch ($this->msg->Event) {
			case 'subscribe':		//	订阅
				$this->_processSubscribe();
				break;
			case 'unsubscribe':
				$this->_processUbsubscribe();
				break;
		}
	}

	private function _processSubscribe() {

	}

	private function _processUbsubscribe() {
	}
}
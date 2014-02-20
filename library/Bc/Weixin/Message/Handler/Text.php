<?php

class Bc_Weixin_Message_Handler_Text extends Bc_Weixin_Message_Handler_Base {
	protected $type = 'text';

	public function process() {
		switch (trim($this->msg->Content)) {
			default:
				$this->analysis();
				break;
		}

		$this->structure->CreateTime = time();
		
		parent::process();
	}

	protected function analysis() {
		
		$this->helpResponse();
	}

	protected function helpResponse() {
		$content = "";

		$this->structure->Content = $content;
	}
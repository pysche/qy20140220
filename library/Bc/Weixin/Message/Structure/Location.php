<?php

class Bc_Weixin_Message_Structure_Location extends Bc_Weixin_Message_Structure_Base
{
	public function __construct()
	{
		$this->Location_X = '';
		$this->Location_Y = '';
		$this->Scale = '';
		$this->Label = '';
		$this->MsgType = 'location';
		
		parent::__construct();
	}
}
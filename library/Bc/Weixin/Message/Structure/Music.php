<?php

class Bc_Weixin_Message_Structure_Music extends Bc_Weixin_Message_Structure_Base
{
	public function __construct()
	{
		$this->Music = new StdClass();
		$this->Music->Title = '';
		$this->Music->Description = '';
		$this->Music->MusicUrl = '';
		$this->Music->HQMusicUrl = '';
		$this->MsgType = 'music';
		
		parent::__construct();
	}
}
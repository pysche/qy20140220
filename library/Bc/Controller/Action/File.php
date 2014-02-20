<?php

class Bc_Controller_Action_File extends Bc_Controller_Action_Base
{
	public function init()
	{
		parent::init();
	}
	
	public function indexAction()
	{
		$post = $this->getRequest()->getPost();
		$hash = trim($this->getRequest()->getParam('hash'));
		
		if ($hash && $_FILES['myfile']) {
			$f = Bc_Uploader::Save(array(
					'file' => 'myfile',
					'hash' => $hash,
					'usage' => 'article'
					));
			unset($f['tmp_name']);
		} else {
			$f = array();
		}
		
		header('Content-Type: text/html; charset=utf8');
		echo "['".implode("','", $f)."']";
		exit(0);
	}

	public function delAction() {
		$fid = trim($this->getRequest()->getParam('fid'));
		Bc_Uploader::Del($fid);
		
		echo json_encode(array());
		exit(0);
	}
	
}
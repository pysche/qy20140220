<?php

class Bc_Controller_Action_Trans extends Bc_Controller_Action_Weshop {
	
	protected $trans = array();

	public function init() {
		parent::init();

		if ($this->user['OrgId']) {
			$this->trans = $this->M('organization')->obyid($this->user['OrgId'], 'trans');
		}
	}

	public function orderCanCancel($order) {
		$can = false;
		if (is_array($order)) {
			$data = &$order;
		} else {
			try {
				$data = $order->toArray();
			} catch (Exception $e) {}
		}
		
		if ($data['Status']!=$this->config->order->status->canceled) {
			$can = true;
		}

		return $can;
	}
}
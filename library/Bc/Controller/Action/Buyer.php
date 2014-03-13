<?php

class Bc_Controller_Action_Buyer extends Bc_Controller_Action_Weshop {
	protected $restrictRole = 'buyer';

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
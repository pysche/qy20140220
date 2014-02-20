<?php

class Bc_View_Helper_Manage extends Bc_View_Helper_Base {
	
	public function Sitefunc(array $data) {
		$str = '';

		$rows = array();
		$data['WebEnabled'] && $rows[] = '网站';
		$data['PanelEnabled'] && $rows[] = '网站后台';
		$data['WeshopEnabled'] && $rows[] = 'Weshop';
		$data['ShopEnabled'] && $rows[] = '商城';

		$str = implode(', ', $rows);

		return $str;
	}
}
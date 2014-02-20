<?php

class Bc_Weixin_Message_Structure_Base
{
	protected $_data = array(
		'ToUserName' => '',
		'FromUserName' => '',
		'CreateTime' => '',
		'MsgType' => '',
		'FuncFlag' => '0',
		'MsgId' => ''
		);

	public function __get($key)
	{
		return isset($this->_data[$key]) ? $this->_data[$key] : null;
	}

	public function __set($key, $val)
	{
		$this->_data[$key] = $val;
	}

	public function __toString()
	{
		$xml = '<xml>';

		foreach ($this->_data as $key=>$value) {
			if (is_array($value)) {
				foreach ($value as $skey=>$svalue) {
					$xml .= '<'.$skey.'><![CDATA['.$svalue.']]></'.$skey.'>';
				}
			} else {
				$xml .= '<'.$key.'><![CDATA['.$value.']]></'.$key.'>';
			}
		}

		$xml .= '</xml>';

		return $xml;
	}

	public function __construct()
	{

	}
}
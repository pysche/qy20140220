<?php

class Bc_Weixin_Message_Handler {

	public static function &factory($message) {
		$handler = null;
		$handlerClass = 'Bc_Weixin_Message_Handler_'.ucfirst(strtolower($message->MsgType));

		if (class_exists($handlerClass)) {
			$handler = new $handlerClass($message);
		}

		return $handler;
	}
}
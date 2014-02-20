<?php

class Bc_Weixin_Message_Structure {

	public static function &factory($message) {
		$handler = null;
		$handlerClass = 'Bc_Weixin_Message_Structure_'.ucfirst(strtolower($message->MsgType));

		if (class_exists($handlerClass)) {
			$handler = new $handlerClass($message);
		}

		return $handler;
	}
}
<?php

/**
 * 缓存处理抽象类
 * 
 * @author pang
 *
 */

abstract class Bc_Cache_Base
{
	protected $prefix = APPLICATION_ENV;
	
	protected static function &loadHandler($handler, array $options=array())
	{
		include_once 'Bc/Cache/Handler/'.ucfirst($handler).'.php';
		$className = 'Bc_Cache_Handler_'.ucfirst($handler);
		$cacheHandler = new ${className}($options);
		
		return $cacheHandler;
	}
}
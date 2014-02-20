<?php

/**
 * 远端缓存处理（Memcached、Mecachedb）
 * 保存与机器无关的缓存，如某些数据库查询结果
 * 
 * @author pang
 *
 */

class Bc_Cache_Remote extends Bc_Cache_Base
{
	protected static $instance = null;
	
	private function __construct()
	{
	}
	
	/**
	 * 获取远端缓存实例
	 * 
	 */
	public static function &getInstance()
	{
		$config = &Bc_Config::appConfig();
		
		if (self::$instance==null) {
			if ($config->cache->handler->remote->name == 'memcache') {
				$options = $config->cache->handler->remote->toArray();
				self::$instance = self::loadHandler('Memcache', $options);
			} else {
				self::$instance = self::loadHandler($config->cache->handler->remote->name);
			}
		}
		
		return self::$instance;
	}
}
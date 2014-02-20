<?php

class Bc_Cache_Handler_File extends Bc_Cache_Handler_Base
{
	public function __construct(array $options=array())
	{
		parent::__construct($options);
	}
	
	public function &get($key)
	{
		$cpath = $this->init($key);
		$val = unserialize(file_get_contents($cpath));
		
		return $val;
	}
	
	public function set($key, $val=null, $ttl=0)
	{
		$result = false;
		
		if ($val==null) {
			$result = $this->delete($key);
		} else {
			$cpath = $this->init($key);
			$fp = fopen($cpath, 'w');
			fwrite($fp, serialize($val));
			fclose($fp);
			
			$result = true;
		}
		
		return $result;
	}
	
	public function delete($key)
	{
		$result = false;
		
		try {
			$cpath = $this->cpath($key);
			
			if (file_exists($cpath)) {
				unlink($cpath);
			}
			$result = true;
		} catch (Exception $e) {}
		
		return $result;
	}
	
	public function cfname($key) {
		return md5($key);
	}
	
	public function cpath($key) {
		$cfname = $this->cfname($key);
		$prefix = APPLICATION_PATH.'/../cache/'.substr($cfname, 0, 1).'/'.substr($cfname, 1, 1);
		if (!is_dir($prefix)) {
			mkdir($prefix, 0777, true);
		}
		
		return $prefix.'/'.$key;
	}
	
	public function init($key) {
		$cpath = $this->cpath($key);
		if (!file_exists($cpath)) {
			touch($cpath);
		}
		
		return $cpath;
	}
}
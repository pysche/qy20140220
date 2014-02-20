<?php

class Bc_Site {
	
	public static function determin($serverName) {
		$siteId = 0;
		
		$cacher = &Bc_Cache_Remote::getInstance();
		$msName = md5($serverName);
		$siteId = $cacher->get('siteid_'.$msName);
		if ($siteId===false) {
			$dao = &Bc_Db::t('Site_Domain');
			$row = $dao->Domain($msName);
			
			if ($row) {
				$siteId = (int)$row->SiteId;
				$cacher->set('siteid_'.$msName, $siteId);
			}
		}
		
		return $siteId;
	}

	public static function reset($serverName) {
		$cacher = &Bc_Cache_Remote::getInstance();
		$msName = md5($serverName);
		$cacher->set('siteid_'.$msName);
	}
	
	public static function &get($siteId) {
		$data = array();
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_info_'.$siteId;
		$data = $cacher->get($key);

		if (!$data) {
			$dao = &Bc_Db::t('sites');
			$row = $dao->id($siteId);

			if ($row) {
				$data = $row->toArray();
				$cacher->set('site_info_'.$siteId);
			}
		}
		
		return $data;
	}
}
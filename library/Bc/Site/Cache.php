<?php

class Bc_Site_Cache {

	public static function &ent($entId, $clean=false) {
		$result = array();
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'ent_'.(int)$entId;

		if ($clean===true) {
			$cacher->set($key);
		} else {
			$tEnt = &Bc_Db::t('ent');
			$ent = $tEnt->id($entId);
			if ($ent) {
				$result = $ent->toArray();
				$cacher->set($key, $result);
			}
		}

		return $result;
	}

	public static function &info($siteId, $clean=false) {
		$result = array();
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_info_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = &Bc_Site::get($siteId);
		}
		
		return $result;
	}
	
	public static function &productCategory($siteId, $clean=false) {
		$result = array();
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_pc_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}	
		
		if (!$result) {
			$result = array();
			$dao = &Bc_Db::t('productcategory');
			$db = $dao->getAdapter();
			$where = $db->quoteInto('SiteId=?', $siteId);
			$where .= ' AND '.$db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('PubFlag=?', 1);
			
			$rows = $dao->fetchAll($where, 'SortNum ASC');
			if ($rows) {
				foreach ($rows as $row) {
					$result[$row->id] = $row;
				}
			}
			
			$cacher->set($key, $result, 3600);
		}
	
		return $result;
	}
	
	public static function &contactus($siteId, $clean=false) {
		$result = false;
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_contactus_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}
	
		if (!$result) {
			$dao = &Bc_Db::t('content');
			$db = $dao->getAdapter();
			$where = $db->quoteInto('SiteId=?', $siteId);
			$where .= ' AND '.$db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('PubFlag=?', 1);
			$where .= ' AND '.$db->quoteInto('Title=?', 'contactus');

			$row = $dao->fetchRow($where);
			$files = $row->Hash ? Bc_File::getByHash($row->Hash) : array();
			
			$result = array(
				'files' => &$files,
				'data' => &$row
				);
			$cacher->set($key, $result, 3600*24);
		}
		
		return $result;		
	}
	
	public static function &aboutus($siteId, $clean=false) {
		$result = false;
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_aboutus_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}
	
		if (!$result) {
			$dao = &Bc_Db::t('content');
			$db = $dao->getAdapter();
			$where = $db->quoteInto('SiteId=?', $siteId);
			$where .= ' AND '.$db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('PubFlag=?', 1);
			$where .= ' AND '.$db->quoteInto('Title=?', 'aboutus');

			$row = $dao->fetchRow($where);
			$files = $row->Hash ? Bc_File::getByHash($row->Hash) : array();

			$result = array(
					'files' => &$files,
					'data' => &$row
			);
			$cacher->set($key, $result, 3600*24);
		}
		
		return $result;
	}
	
	public static function &area($siteId, $clean=false) {
		$result = false;
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_area_'.$siteId;

		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}
		
		if (!$result) {
			$area = &Bc_Db::t('area');
			$db = &$area->getAdapter();
			$where = $db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('SiteId=?', $siteId);
			$rows = $area->fetchAll($where);
	
			$kvs = $arr = array();
			if ($rows) {
				foreach ($rows as $row) {
					$arr[$row['id']] = array(
							'id' => $row['id'],
							'ParentId' => $row['ParentId'],
							'Name' => $row['Name'],
							'CreateTime' => $row['CreateTime']
						);
					
					$kvs[$row['id']] = $row['Name'];
				}
			} else {
				$arr[] = array(
						'id' => 1,
						'ParentId' => 0,
						'name' => '暂无分类'
				);
			}
			
			$result = array(
				'tree' => &$arr,
				'kvs' => &$kvs
				);

			$cacher->set($key, $result, 3600*24);
		}
		
		return $result;
	}
	
	public static function &goodsclass($siteId, $clean=false) {
		$result = false;
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_goodsclass_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}
		
		if (!$result || !$result['tree'] || !$result['kvs']) {
			$area = &Bc_Db::t('goodsclass');
			$db = &$area->getAdapter();
			$where = $db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('SiteId=?', $siteId);
			$rows = $area->fetchAll($where);
			
			$kvs = $arr = array();
			if ($rows) {
				foreach ($rows as $row) {
					$arr[] = array(
							'id' => $row['id'],
							'ParentId' => $row['ParentId'],
							'Name' => $row['Name'],
							'CreateTime' => $row['CreateTime']
						);
					
					$kvs[$row['id']] = $row['Name'];
				}
			} else {
				$arr[] = array(
						'id' => 1,
						'ParentId' => 0,
						'name' => '暂无分类'
				);
			}

			$result = array(
					'tree' => &$arr,
					'kvs' => &$kvs
			);
			
			$cacher->set($key, $result, 3600*24);
		}
		
		return $result;
	}
	
	public static function &entclass($siteId, $clean=false) {
		$result = false;
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'site_entclass_'.$siteId;
		
		if ($clean===true) {
			$cacher->set($key);
		} else {
			$result = $cacher->get($key);
		}
		
		if (!$result || !$result['tree'] || !$result['kvs']) {
			$area = &Bc_Db::t('entclass');
			$db = &$area->getAdapter();
			$where = $db->quoteInto('Deleted=?', 0);
			$where .= ' AND '.$db->quoteInto('SiteId=?', $siteId);
			$rows = $area->fetchAll($where);
			
			$kvs = $arr = array();
			if ($rows) {
				foreach ($rows as $row) {
					$arr[] = array(
							'id' => $row['id'],
							'ParentId' => $row['ParentId'],
							'Name' => $row['Name'],
							'CreateTime' => $row['CreateTime']
						);
					
					$kvs[$row['id']] = $row['Name'];
				}
			} else {
				$arr[] = array(
						'id' => 1,
						'ParentId' => 0,
						'name' => '暂无分类'
				);
			}

			$result = array(
					'tree' => &$arr,
					'kvs' => &$kvs
			);
			
			$cacher->set($key, $result, 3600*24);
		}
		
		return $result;
	}
}
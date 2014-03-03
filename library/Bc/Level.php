<?php

class Bc_Level {
	protected $tbl = '';
	protected $idKey = '';
	protected $parentKey = '';
	protected $sortKey = '';
	protected $nameKey = '';
	protected $dao = null;
	
	protected $depth = 0;
	protected $depStr = '';
	protected $subIds = array();
	
	public $fids = array();
	
	public function __construct(array $params) {
		$this->tbl = $params['tbl'];
		$this->idKey = $params['id_key'];
		$this->parentKey = $params['parent_key'];
		$this->sortKey = $params['sort_key'];
		$this->nameKey = $params['name_key'];
		
		$this->dao = &Bc_Db::t($this->tbl);
	}
	
	public function __get($key) {
		$result = null;
		
		$cacher = &Bc_Cache_Remote::getInstance();
		switch ($key) {
			case 'levelSelect':
				$key = 'level_select_'.$this->tbl;
				$result = $cacher->get($key);
				if (!$result) {
					$this->rebuildCache();
					$result = $cacher->get($key);
				}
				break;
			case 'levels':
				$key = 'levels_'.$this->tbl;
				$result = $cacher->get($key);
				if (!$result) {
					$this->rebuildCache();
					$result = $cacher->get($key);
				}
				break;
			case 'levelNames':
				$key = 'level_names_'.$this->tbl;
				$result = $cacher->get($key);
				if (!$result) {
					$this->rebuildCache();
					$result = $cacher->get($key);
				}
				break;
		}
		
		return $result;
	}
	
	public function getSubTypeIds($id=0, $withName=false, $depStr='--', $cache=false) {
		$rows = $this->dao->subs($id);
		$this->depth++;
		
		foreach ($rows as $row) {
			if (!$withName) {
				$this->subIds[] = $row[$this->idKey];
			} else {
				if ($row[$this->parentKey]) {
					if (@!in_array($r[$this->idKey], $this->subIds)) {
						$this->depStr = str_repeat($depStr, $this->depth);
					}
				} else {
					$this->depth = 0;
					$this->depStr = '';
				}
				
				if ($cache) {
					$this->subIds[$row[$this->parentKey]][$row[$this->idKey]] = $row[$this->nameKey];
				} else {
					$this->subIds[$row[$this->idKey]] = $this->depStr.$row[$this->nameKey];
				}
			}
			
			$dep = $this->depth;
			$this->getSubTypeIds($row[$this->idKey], $withName, $depStr, $cache);
			$this->depth = $dep;
		}
	}
	
	public function getParent($parentId=0, $flag=true) {
		$result = null;
		
		if ($parentId && $flag) {
			$row = $this->dao->findById($parentId);
			
			if ($row) {
				$this->fids[] = array(
					$row[$this->idKey], $row[$this->nameKey]
				);
				
				if ($row[$this->parentKey]) {
					$this->getParent($row[$this->parentKey]);
				}
			}
		} else {
			$row = $this->dao->findById($parentId);
			$result = $row[$this->parentKey];
		}
		
		return $result;
	}
	
	public function cacheGetSubTypeIds($id) {
		$ids = array();
		$ids[] = $id;
		
		$cacher = &Bc_Cache_Remote::getInstance();
		$key = 'levels';
		$data = $cacher->get($key);
		
		if ($data===false) {
			$this->rebuildCache();
			$data = $cacher->get($key);
		}
		
		if (is_array($data) && count($data)>0) {
			foreach ($data[$id] as $k=>$v) {
				if (count($data[$k])>0) {
					$tmp = $this->cacheGetSubTypeIds($k);
					foreach ($tmp as $vv) {
						$ids[] = $vv;
					}
				} else {
					$ids[] = $k;
				}
			}
		}
		
		return $ids;
	}
	
	public function rebuildCache() {
		$cacher = &Bc_Cache_Remote::getInstance();
		
		$this->subIds = array();
		$this->getSubTypeIds(0, true, '', true);
		$ck = 'levels_'.$this->tbl;
		$cacher->set($ck, $this->subIds);
		
		$levels = array();
		$rows = $this->dao->simpleAll();
		foreach ($rows as $row) {
			$levels[$row[$this->idKey]] = $row[$this->nameKey];
		}
		
		$ck = 'level_names_'.$this->tbl;
		$cacher->set($ck, $levels);
		
		$this->subIds = array();
		$this->getSubTypeIds(0, true);
		$ck = 'level_select_'.$this->tbl;
		$cacher->set($ck, $this->subIds);
	}
}
<?php

class Bc_Db {

	protected static $tables = array();

	public static function &t($table) {
		if (!isset(self::$tables[strtolower($table)])) {
			$class = 'Bc_Db_Table_'.ucfirst($table);
			if (!class_exists($class)) {
				eval('class '.$class.' extends Bc_Db_Table {}');
			}

			self::$tables[strtolower($table)] = new $class();
			self::$tables[strtolower($table)]->init();
		}

		return self::$tables[strtolower($table)];
	}
}
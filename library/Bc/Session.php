<?php

class Bc_Session
{
	protected static $modules = array();
	protected $module = 'default';

	public static function &i($module = 'default') {
		if (!isset(self::$modules[$module])) {
			self::$modules[$module] = new self();
			self::$modules[$module]->module = $module;
			self::$modules[$module]->_init();
		}

		return self::$modules[$module];
	}

	private function __construct() {
	}

	private function _init() {
		if (session_id() === '') {
			session_start();
		}

		if (!isset($_SESSION[$this->module])) {
			$_SESSION[$this->module] = array();
		}
	}

	public function get($key) {
		return $_SESSION[$this->module][$key];
	}

	public function set($key, $val=null) {
		if ($val===null) {
			unset($_SESSION[$this->module][$key]);
		} else {
			$_SESSION[$this->module][$key] = $val;
		}
	}
}
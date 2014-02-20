<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {
	public function __construct($application) {
		parent::__construct($application);
	
		$config = &Bc_Config::getInstance();
		$front = Zend_Controller_Front::getInstance();
		$router = new Zend_Controller_Router_Rewrite();
	
		if ($config->bc->domain_maps) {
			$i = 0;
			foreach ($config->bc->domain_maps as $map) {
				list($module, $domain) = explode('|', $map);

				$hr = new Zend_Controller_Router_Route_Hostname($domain, array(
					'module' => $module
					));
				$ppr = new Zend_Controller_Router_Route_Static('');
				$router->addRoute('dm_'.($i++), $hr->chain($ppr));
			}
		}
		
		$front->setRouter($router);
	}
	

}


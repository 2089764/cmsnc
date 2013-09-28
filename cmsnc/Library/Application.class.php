<?php

/**
 *  Application.class.php    
 *
 * @author              LuJunJian <CmsSuper@163.com>
 * @copyright			(C) 2012-2013 CMSNC
 * @license				http://www.cmsnc.net/license/
 * @lastmodify			2013-9-25
 */


class Application {

    
	public function __construct() {
	
		if(!get_magic_quotes_gpc()) {
			$_POST    = _addslashes($_POST);
			$_GET     = _addslashes($_GET);
			$_REQUEST = _addslashes($_REQUEST);
			$_COOKIE  = _addslashes($_COOKIE);
		}
		
		$this->route = Import::sysClass('Route');
		$this->run($app);
	}
	
	/**
	*  运行应用
	*  @param object $app 
	*/
	public function run($app){
	
		$app = Import::loadModule($this->route->getModule(),$this->route->getController());
		if(!$app){
		    showMessage($this->route->getController().'控制器不存在');
		}
		
		if (method_exists($app, $this->route->getAction())) {
		    call_user_func(array($app, $this->route->getAction()));
		} else {
			showMessage($this->route->getAction().'方法不存在');
		}
	}
}
<?php

/**
 *  Route.class.php     路由
 *
 * @author              LuJunJian <CmsSuper@163.com>
 * @copyright			(C) 2012-2013 CMSNC
 * @license				http://www.cmsnc.net/license/
 * @lastmodify			2013-9-25
 */


class Route {

  	//$config = Import::loadConfig('Route','default');
		
	//	var_dump($config);
	
	
	//路由配置
	private $route_config = '';
	private $route_key = array();
	
	public function __construct() {
        
		//获取自定义路由配置
	    $route = Import::loadConfig('System','route');
		
    	$this->route_config = Import::loadConfig('Route',SITE_URL) ? Import::loadConfig('Route',SITE_URL) : Import::loadConfig('Route',$route);
		
		if(isset($this->route_config['data']['POST']) && is_array($this->route_config['data']['POST'])) {
			foreach($this->route_config['data']['POST'] as $_key => $_value) {
				if(!isset($_POST[$_key])) $_POST[$_key] = $_value;
			}
		}
		if(isset($this->route_config['data']['GET']) && is_array($this->route_config['data']['GET'])) {
			foreach($this->route_config['data']['GET'] as $_key => $_value) {
				if(!isset($_GET[$_key])) $_GET[$_key] = $_value;
			}
		}
		
		//获取自定义路由key
		$this->route_key = array_keys($this->route_config);
	}
  
    public function getModule(){
	
	    $key = $this->route_key[0];
		
	    $m = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : (isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : '');
		$m = safe_deal($m);		
		if (empty($m)) {
			return $this->route_config[$key];
		} else {
			if(is_string($m)) return $m;
		}
	}
	
    public function getController(){
	
	    $key = $this->route_key[1];
		
	    $c = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : (isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : '');
	    $c = safe_deal($c);		
		if (empty($c)) {
			return $this->route_config[$key];
		} else {
			if(is_string($c)) return $c;
		}
		
	}
    public function getAction(){
	
	    $key = $this->route_key[2];
		
	    $a = isset($_GET[$key]) && !empty($_GET[$key]) ? $_GET[$key] : (isset($_POST[$key]) && !empty($_POST[$key]) ? $_POST[$key] : '');
		$a = safe_deal($a);			
		if (empty($a)) {
			return $this->route_config[$key];
		} else {
			if(is_string($a)) return $a;
		}
	}
}
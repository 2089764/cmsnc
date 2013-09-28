<?php
/**
 *  Impotr.class.php     提供载入文件&实例化类
 *
 * @author              LuJunJian <CmsSuper@163.com>
 * @copyright			(C) 2012-2013 CMSNC
 * @license				http://www.cmsnc.net/license/
 * @lastmodify			2013-9-25
 */


class Import {
	
	
	
	/**
	 * 
	 * 导入系统类文件
	 * @param string $classname        类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	public static function sysClass($classname, $path ='', $instantiation = TRUE){
		return self::_loadClass($classname, $path, $instantiation);
	}
	
	
	/**
	 * 
	 * 导入应用类文件
	 * @param string $classname        类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	public static function appClass($classname, $path ='', $instantiation = TRUE){
		
		if(empty($path)) $path = APP_PATH.'Library'.DIRECTORY_SEPARATOR;

		return self::_loadClass($classname, $path, $instantiation);
	}
	
	
	
	/**
	 * 
	 * 导入数据库模型
	 * @param string $classname        类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	public static function loadModel($classname, $path ='', $instantiation = TRUE){
		
		self::sysClass('Model');
		
		if(empty($path)) $path = APP_PATH.'Model'.DIRECTORY_SEPARATOR;
		
		return self::_loadClass($classname.'Model', $path, $instantiation);
	}
	
	
	/**
	 * 
	 * 加载模块
	 * @param string $module           模块 
	 * @param string $classname        类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	public static function loadModule($module, $classname, $path ='', $instantiation = TRUE){
				
		if(empty($path)) $path = APP_PATH.'Module'.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR;
		
		if(!is_dir($path)) showMessage('模块路径错误.');
		
		return self::_loadClass($classname, $path, $instantiation);
	}
	
	

	/**
	 * 
	 * 加载类文件
	 *
	 * @param string $classname        类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	
	private static function _loadClass($classname, $path, $instantiation = TRUE){

		static $getArrarClass = array();
		
		if(!$path) $path = SYS_PATH.'Library'.DIRECTORY_SEPARATOR;
		
		$key = md5($path.$classname);
		
		if(isset($getArrarClass[$key])){
		    
			if(!empty($getArrarClass[$key])){
		        
				return $getArrarClass[$key];
		        
			}else{
		
				return true;
			}
				
		}

		if(file_exists($path.$classname.'.class.php')){
			
			include $path.$classname.'.class.php';
			
			if($instantiation){
			    $getArrarClass[$key] = new $classname;
			}else{
			    $getArrarClass[$key] = TRUE;
			}
			
			return $getArrarClass[$key];
		
		}else{
			return false;
		}
	}
	
	
	
	
	/**
	 * 
	 * 导入系统函数文件
	 * @param staring $fname     函数名
	 * @param string $path 路径
	 */
	public function sysFunction($fname, $path =''){
		return self::_loadFunction($fname);
	}
	
	
	
	
	/**
	 * 
	 * 导入应用函数文件
	 * @param staring $fname     函数名
	 * @param string $path 路径
	 */
	public function appFunction($fname, $path =''){
		
		if(empty($path)) $path = APP_PATH.'Common'.DIRECTORY_SEPARATOR.$fname.'.func.php';

		return self::_loadFunction($fname,$path);
	}

	/**
	 * 
	 * 加载函数文件
	 * @param staring $fname     函数名
	 * @param string $path 路径
	 */	
	private static function _loadFunction($fname, $path =''){
	
	    static $getArrayFunction = array();
	    if(!$path) $path = SYS_PATH.'Common'.DIRECTORY_SEPARATOR.$fname.'.func.php';
	    
	    $key = md5($path);
	    
	    if (isset($getArrayFunction[$key])) return true;
		if (file_exists($path)) {
			include $path;
	
     	} else {
			$getArrayFunction[$key] = false;
			return false;
		}
		
		$getArrayFunction[$key] = true;
		return true;
	}
	
	
		
	/**
	 * 加载配置文件
	 * @param string $file     配置文件
	 * @param string $key      要获取的配置荐
	 * @param string $path     自定义配置文件路径
	 * @param string $default  默认配置。当获取配置项目失败时该值发生作用。
	 * @param boolean $reload  强制重新加载。
	 */
	public static function loadConfig($file, $key = '', $path='', $default = '', $reload = false) {
		
		static $configs = array();
		
		if (!$reload && isset($configs[$file])) {
			if (empty($key)) {
				return $configs[$file];
			} elseif (isset($configs[$file][$key])) {
				return $configs[$file][$key];
			} else {
				return $default;
			}
		}
	
    	if(!$path) $path = APP_PATH.'Configs'.DIRECTORY_SEPARATOR;
		
		if (file_exists($path)) {
		
		    $configs[$file] = include $path.$file.'.config.php';
		
		}else{
		    $path = SYS_PATH.'Configs'.DIRECTORY_SEPARATOR;
			$configs[$file] = include $path.$file.'.config.php';
		}
		
		if (empty($key)) {
			return $configs[$file];
		} elseif (isset($configs[$file][$key])) {
			return $configs[$file][$key];
		} else {
			return $default;
		}
	}
}


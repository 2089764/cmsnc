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
	
    	
	public static function SystemClass($classname, $path ='', $instantiation = TRUE){
		return Import::_loadClass($classname, $path, $instantiation);
	}
	

	/**
	 * 
	 * 加载类文件
	 *
	 * @param unknown_type $classname  类名
	 * @param string  $path            导入文件路径
	 * @param boolean $instantiation   是否实例化
	 */
	
	private static function _loadClass($classname, $path, $instantiation = TRUE){
        
		//多例
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
		
		
		//导入文件
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
	
	
	
	

}


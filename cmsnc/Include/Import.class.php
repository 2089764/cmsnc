<?php
/**
 *  Impotr.class.php     �ṩ�����ļ�&ʵ������
 *
 * @author              LuJunJian <CmsSuper@163.com>
 * @copyright			(C) 2012-2013 CMSNC
 * @license				http://www.cmsnc.net/license/
 * @lastmodify			2013-9-25
 */


class Import {
	
	
	
	/**
	 * 
	 * ����ϵͳ���ļ�
	 * @param string $classname        ����
	 * @param string  $path            �����ļ�·��
	 * @param boolean $instantiation   �Ƿ�ʵ����
	 */
	public static function sysClass($classname, $path ='', $instantiation = TRUE){
		return self::_loadClass($classname, $path, $instantiation);
	}
	
	
	/**
	 * 
	 * ����Ӧ�����ļ�
	 * @param string $classname        ����
	 * @param string  $path            �����ļ�·��
	 * @param boolean $instantiation   �Ƿ�ʵ����
	 */
	public static function appClass($classname, $path ='', $instantiation = TRUE){
		
		if(empty($path)) $path = APP_PATH.'Library'.DIRECTORY_SEPARATOR;

		return self::_loadClass($classname, $path, $instantiation);
	}
	
	
	
	/**
	 * 
	 * �������ݿ�ģ��
	 * @param string $classname        ����
	 * @param string  $path            �����ļ�·��
	 * @param boolean $instantiation   �Ƿ�ʵ����
	 */
	public static function loadModel($classname, $path ='', $instantiation = TRUE){
		
		self::sysClass('Model');
		
		if(empty($path)) $path = APP_PATH.'Model'.DIRECTORY_SEPARATOR;
		
		return self::_loadClass($classname.'Model', $path, $instantiation);
	}
	

	/**
	 * 
	 * �������ļ�
	 *
	 * @param string $classname        ����
	 * @param string  $path            �����ļ�·��
	 * @param boolean $instantiation   �Ƿ�ʵ����
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
	 * ����ϵͳ�����ļ�
	 * @param staring $fname     ������
	 * @param string $path ·��
	 */
	public function sysFunction($fname, $path =''){
		return self::_loadFunction($fname);
	}
	
	
	
	
	/**
	 * 
	 * ����Ӧ�ú����ļ�
	 * @param staring $fname     ������
	 * @param string $path ·��
	 */
	public function appFunction($fname, $path =''){
		
		if(empty($path)) $path = APP_PATH.'Common'.DIRECTORY_SEPARATOR.$fname.'.func.php';

		return self::_loadFunction($fname,$path);
	}

	/**
	 * 
	 * ���غ����ļ�
	 * @param staring $fname     ������
	 * @param string $path ·��
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
	
	
	
	
	
	
	

}


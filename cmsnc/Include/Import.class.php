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
	
    	
	public static function SystemClass($classname, $path ='', $instantiation = TRUE){
		return Import::_loadClass($classname, $path, $instantiation);
	}
	

	/**
	 * 
	 * �������ļ�
	 *
	 * @param unknown_type $classname  ����
	 * @param string  $path            �����ļ�·��
	 * @param boolean $instantiation   �Ƿ�ʵ����
	 */
	
	private static function _loadClass($classname, $path, $instantiation = TRUE){
        
		//����
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
		
		
		//�����ļ�
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


<?php
/**
 *  CmsNc.php     This is the entrance CMSNC system files
 *
 * @author              LuJunJian <CmsSuper@163.com>
 * @copyright			(C) 2012-2013 CMSNC
 * @license				http://www.cmsnc.net/license/
 * @lastmodify			2013-9-25
 */



if(version_compare(PHP_VERSION,'5.2.0','<'))  die('require PHP > 5.2.0 !');

define('CMSNC', true);

//框架所在目录
define('SYS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

define('INCLUDE_PATH', SYS_PATH.'Include'.DIRECTORY_SEPARATOR);

//当前访问的主机名
define('SITE_URL', (isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : ''));

//初始化框架
CmsNc::init();
//初始化应用
CmsNc::createApplication();


class CmsNc {
	
    /**
     * 
     * 初始化应用程序
     */
	public static function createApplication(){

		return Import::sysClass('Application');
	}
	
	public static function init(){

	    include INCLUDE_PATH.'Import.class.php';
	
	    //加载系统函数
        Import::sysFunction('Common');
		
	    //加载路由
        Import::sysFunction('Route');
	}

}




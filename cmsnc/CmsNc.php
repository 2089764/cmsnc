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


//�������Ŀ¼
define('SYS_PATH', dirname(__FILE__).DIRECTORY_SEPARATOR);


define('INCLUDE_PATH', SYS_PATH.'Include'.DIRECTORY_SEPARATOR);


include INCLUDE_PATH.'Import.class.php';

//����ϵͳ����
Import::sysFunction('Common');


class CmsNc {
	
    /**
     * 
     * ��ʼ��Ӧ�ó���
     */
	public static function createApplication(){
		
		
		$db = Import::loadModel('Member');
		
		$db->sql();

		return Import::sysClass('Application');
	}

}

CmsNc::createApplication();
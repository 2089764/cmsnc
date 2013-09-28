<?php

/**
*  提示信息
*  @param string $msg    提示内容
*  @param string $isdie  是否结束程序
*/
function showMessage($msg, $isdie=true){
    echo '<font color="red">',$msg,'</font>';
	if($isdie) die();
}


/**
 * 返回经addslashes处理过的字符串或数组
 * @param $string 需要处理的字符串或数组
 * @return mixed
 */
function _addslashes($string){
	if(!is_array($string)) return addslashes($string);
	foreach($string as $key => $val) $string[$key] = _addslashes($val);
	return $string;
}

/**
 * 安全处理函数
 * 
 */
function safe_deal($str) {
	return str_replace(array('/', '.'), '', $str);
}

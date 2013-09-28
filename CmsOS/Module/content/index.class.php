<?php


//控制器

class index{


    public function init(){
	
		$db = Import::loadModel('Member');
		
	    $db->sql();
		var_dump($_GET);
	    echo "hello world";
	}


}

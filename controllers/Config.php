<?php

class Config{
	// function get will search for the configuration defined in init.php file. 
	//If given path exists it will return value otherwise it will return false.
	public static function get($path= null){
		if($path){ // if path is givin when calling a function
			$config = $GLOBALS['config'];
			$path = explode('/',$path);
			foreach($path as $bit){
				if(isset($config[$bit])){
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}


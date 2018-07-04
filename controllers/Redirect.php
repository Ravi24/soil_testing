<?php

class Redirect{
	public static function redirectTo($location){
		if($location){
			if(is_numeric($location))
			{
				switch ($location) {
					case 404:
							header('HTTP/1.0 404 Not Found');
							include '../errors/404.php';
							exist();
						break;
				}
			}
			header('location: '.$location);
			exit();
		}
	}
}
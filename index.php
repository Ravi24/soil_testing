<?php
	//header("location:views/pages/index.php");
require_once('controllers/init.php');

//$user = Db::getInstance()->query("select * from users where name = ?",array('Ravi'));
//$user = Db::getInstance()->get('users',array('name','=','bitcodes'));

/*$userinsert = Db::getInstance()->insert('users',array(
	'name' => 'bitcodes',
	'code' => 'bit',
	'email' => 'bitcodesindia@outlook.com',
	'mobile' => '1234567891',
	'password' => 'password'
));*/

//if($user->count()){
//	foreach($user->results() as $result){
//		echo $result->name . '<br/>';
//	}
//}

$keys = Db::getInstance()->update('users',array(
	'name' => 'testy',
	'email' => 'email@gmail.com'
), array('id' => 1));

print_r($keys);



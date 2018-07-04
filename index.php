<?php
	header("location:views/templates/login/login.php");
//require_once('controllers/init.php');

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




// Update records
//$keys = Db::getInstance()->update('users',array(
//	'name' => 'testUpdate',
//	'email' => 'emailTest@gmail.com',
//	'code' => '1111'
//), array('id' => 2));

echo Db::getInstance()->count().'Rows affected';



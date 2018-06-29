<?php
namespace soil;
	session_start();
class DbConfig{

	public function dbConn(){
		$this->host = 'localhost';
		$this->user = 'root';
		$this->password = '';
		$this->database = 'soil_lab';
		$this->mysqli = mysqli_connect($this->host, $this->user, $this->password, $this->database);
		if($this->mysqli == true){
			return $this->mysqli;
		}
		else{
			return false;
		}
	}
	public function dataTable($sql, $pram=[]){
		$result = $this->dbConn()->query($sql);
		if($result){
			return $result;
		}
		else{
			$_SESSION['errors'] = dbConn()->errorInfo();
		}
	}
}
$DbConfig = new DbConfig;
$sql = "select * from users where email='iqravi.bhushan@gmail.com'and password='Ravi@123'";
$result = $DbConfig->dataTable($sql);
if(isset($_SESSION['errors'])){
	echo "Error occured".$_SESSION['errors'];
}
else{
	
		if(!$result){
			echo 'No record found!';
		}
		else
		{
			while($data = mysqli_fetch_assoc($result))
			{
				print_r($data);

			}	
		}
		
}
?>
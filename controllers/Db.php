<?php 

require_once 'init.php';
Class Db{
	private static $_instance = null;
	private  $_pdo, $_query, $_error = false, $_results, $_count;

///This function is going to create a PDO  when you instantiate 'Db' Class;
	private function __construct()
	{
		try{
			$this->_pdo = new PDO('mysql:host='.Config::get('mysql/host').'; dbname='.Config::get('mysql/database').'',Config::get('mysql/user'),Config::get('mysql/password'));

		}catch(PDOException $e){
			die($e->getMessage());
		}
	}

	// This function will check if Class is instantiated or not? if it is already instantiated it will set $_instance to PDO and return it. If it is not already instantiated, It will instantiate the class and set $instance to Db;

	public static function getInstance(){
		if(!isset(self::$_instance)){
			self::$_instance = new Db();
		}
		return self::$_instance;
	}

	public function query($sql, $params = array())
	{
		$this->_error = false;
		if($this->_query= $this->_pdo->prepare($sql)){
			$x = 1;
			if(count($params)){
				foreach($params as $key=>$param){
					
					$this->_query->bindValue($x, $param);
					$x++;
				}
			}
			if($this->_query->execute()){
				$this->_results = $this->_query->fetchall(PDO::FETCH_OBJ);
				$this->_count = $this->_query->rowCount();
			}
			else{
				$this->_error = true;
			}
			return $this;
		}
	}

	private function action($action, $tableName, $where = array()){
		
		//if length of $where array is 3 then arrange them in following manner
		// for example select * from users where name = 'admin';
		// in above query there is a where clause in whtich there are three parts 
		//(1). Column name. (2). operator (3). Value of column to compare
		if(count($where) === 3){
			$operators = array('=', '!=', '<', '>', '<=', '>=');

			$field = $where[0];
			$operator = $where[1]; // $where[1] is the operator in where clause. here assingning it to $operator variable .
			$value = $where[2];

			if(in_array($operator, $operators)){ // in_array() function searches for the value in array.
				$sql = "{$action} from {$tableName} where {$field} {$operator} ?";
				
				/* calling query function which is written above and check if there is any error or not?
				 i.e. execute query(which prepares the query and if there is any error it set $_error to true) function and check if there is any error or not.
				 */
				if(!$this->query($sql,array($value))->error()){
					// if there is not an error return this otherwise return false.
					return $this;
				}
			}
		}
		return false;
	}

	public function get($tableName, $where)
	{
		return $this->action('Select * ', $tableName, $where);
	}
	public function delete($tableName, $where){
		return $this->action('Delete', $tableName, $where);	
	}
	public function update($tableName, $setFields = array(), $Conditionalfields = array()){
		// Example of query -> update users set name = 'test', email = 'xyz' where id = 2;
		$this->_error = false;
		if(count($setFields)){
			$setColumnKeys = array_keys($setFields); // get each key of $setFields array
			$setPart =''; // will store set part of update query
			$x = 1;
			$key = ''; // store individual key of $setFields array
			$value = ''; // store individual value of $setFields array
			// below foreach will construct set part of update query.
			foreach($setColumnKeys as $keyName){
				$key = $keyName;
				$value = "'".$setFields[$key]."'";
				$setPart .= '`'.$key.'`' . '=' . $value; 
				if($x < count($setFields)){
					$setPart .= ', ';
				}
				$x++;
			}
			
		// construct where part of update sql;
			if(count($Conditionalfields)){
				$whereKeys = array_keys($Conditionalfields);
				$wherePart = '';
				$y = 1;
				$whereKey = '';
				$whereValue = '';
				foreach($whereKeys	as $whereKeyName)
				{
					$whereKey = $whereKeyName;
					$whereKeyValue = $Conditionalfields[$whereKey];
					$wherePart .= '`'.$whereKey .'`' .' = '. $whereKeyValue;
					if($y < count($whereKeys))
					{
						$wherePart .= ', ';
					}
					$y++;
				}
				$sql = "Update {$tableName} set {$setPart} where {$wherePart}";
				
				if($this->_query = $this->_pdo->prepare($sql))
				{
					print_r($this->_query);
					try{
						$this->_query->execute();
					}catch(PDOException $e){
						die($e->getMessage());
					}
				}

			}
		}	
	}
	
	public function insert($table, $fields = array()){
		if(count($fields)){
			$keys = array_keys($fields);
			$values = '';
			$x = 1;

			foreach($fields as $field){
				$values .= '?';
				if($x < count($fields))
				{
					$values .= ', ';
				}
				$x++;
			}
			
			$sql = "insert into {$table} (`". implode('`, `',$keys). "`) values({$values})";
			if(!$this->query($sql, $fields)->error())
			{
				return true;
			}
		}
		return false;
	}

	public function results(){
		return $this->_results;
	}
	public function first(){
		return $this->results()[0];
	}
	public function last(){

		if($this->_count >= 1){
			return $this->results()[$this->_count-1];
		}
		return false;
	}

	public function count(){
		return $this->_count;
	}
	// return error message if there is an error;
	public function error()
	{
		return $this->_error;
	}



}

//https://www.youtube.com/watch?v=PaBWDOBFxDc

//https://www.youtube.com/watch?v=FCnZsU19jyo
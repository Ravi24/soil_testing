<?php 

	class User{
		private $_db;

		public function __construct(){
			$this->_db = DB::getInstance();
		}
		public function create($fields = array()){
			if(!$this->_db->insert('Users',$fields)){
				throw new Exception ('There is a problem in creating user!');
			}
			else{

			}
		}
		public function login($userName = null, $password = null){

			$data = Db::getInstance()->find('users','email',array('email','=',Input::get('email')));
			$user = $data->first();
			
			
				if($data->count()){
					if($user->password === Hash::make(Input::get('password'),$user->salt))
					{
						echo 'logged in';
					}
					else{
						echo 'login failed';
					}
				}
				else{
					echo 'no result';
				}
			
		}
	}

?>
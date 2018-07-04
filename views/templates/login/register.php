<?php 
	
	require_once('../../../controllers/init.php');
	$validate = new Validate;
	if(Input::exists()){
		if(Token::check(Input::get('token'))){
			$validations = $validate->check($_POST,array(
				'name' => array(
					'required' => 'true',
					'min' => 4,
					'max' => 20
				),
				'code' => array(
					'required' => 'true',
					'min' => 4,
					'max' => 10,
				),
				'password' => array(
					'required' => 'true',
					'min' => 4,
					'max' => 10,
				),
				'password_confirmation' => array(
					'required' => 'true',
					'min' => 4,
					'max' => 10,
				)
			));
		}
	}
		if($validate->passed()){
			$user = new User;
			$salt = Hash::salt(32);
			try{
				$user->create(array(
					'name' => Input::get('name'),
					'code' => Input::get('code'),
					'salt' => $salt,
					'email' => Input::get('email'),
					'password' => Hash::make(Input::get('password'),$salt)
				));
			}catch(Exception $e)
			{
				die($e->getMessage());
			}
			Session::flash('register_success','You registered Succesfully!');
			Redirect::redirectTo('login.php');
		}
		else{
			echo $validate->passed();
			echo '<ul>';
				foreach($validate->errors() as $error)
				{
					echo "<li>".strtoupper($error)."</li>";
				}
			echo '</ul>';
		}

?>
<html>
<head>
	<title>Login V1</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="../../../public/login_stuff/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/css/util.css">
	<link rel="stylesheet" type="text/css" href="../../../public/login_stuff/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="../../../public/login_stuff/images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" name="frmRegister" method="POST" action="">
					
					<span class="login100-form-title">
						Register User
					</span>
					<div class="wrap-input100 "> <!-- validate-input-->
						<input class="input100" type="text" name="name" id="name" placeholder="Name" 
						placeholder="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 ">
						<input class="input100" type="text" name="code" placeholder="Code" id="code" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>



					<div class="wrap-input100 " > <!--- data-validate = "Valid email is required: ex@abc.xyz" -->
						<input class="input100" type="text" name="email" placeholder="Email"
						id="email" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100" > <!-- data-validate = "Password is required" -->
						<input class="input100" type="password" name="password" placeholder="Password"
						id="password" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100" >
						<input class="input100" type="password" name="password_confirmation" placeholder="Confirm Password"
						id="password_confirmation" value="">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input type="Submit" name="Submit" class="login100-form-btn" value = "Register">
					</div>
					
					<div class="text-center p-t-136">
						<a class="txt2" href="login.php">
							Already Have Account? Login 
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
						<input type="hidden" name="token" value="<?php echo Token::generate();?>">	
				</form>
			</div>
		</div>
			<div class="rounded alert-danger mt-5">
						
						
			</div>	
					
	</div>
	
			

	
<!--===============================================================================================-->	
	<script src="../../../public/login_stuff/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="../../../public/login_stuff/vendor/bootstrap/js/popper.js"></script>
	<script src="../../../public/login_stuff/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="../../../public/login_stuff/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="../../../public/login_stuff/vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="../../../public/login_stuff/js/main.js"></script>

</body>
</html>


<?php 
	include("includes/config.php");
	include("includes/classes/Account.php");

	//Create a new instance of Account object into $account and pass in connection from config.php
	$account = new Account($con);

	include("includes/handlers/register-handler.php");
	include("includes/handlers/login-handler.php");

	function getInputValue($name) {
		if(isset($_POST[$name])) {
			echo $_POST[$name];
		}
	}

?>

<!DOCTYPE HTML>
<html>
<head>
	<meta charset = "utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Welcome to VoiseM</title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
	
	<link rel="stylesheet" type="text/css" href="assets/css/register.css">

</head>
<body>
	
	<div id="main-background">
		<div id="loginContainer">
			<div class="inputContainer">
				<form  id="loginForm" action="register.php" method="POST">
				
					<h2>Login to your account</h2>

					<p>	
						<?php echo $account->getError("The username and password is incorrect"); ?>
						<label for="loginUsername">Username</label>
						<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g John123" value="<?php echo getInputValue('loginUsername') ?>" required></input>
					</p>

					<p>
						<label for="loginPassword">Password</label>
						<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password"  value="<?php echo getInputValue('loginPassword') ?>" required></input>
					</p>

					<button type="submit" name="loginButton">LOG IN</button>
					
					<div class="accountText">
						<span id="hideLogin">Don't have an account yet? Sign Up here</span>
					</div>
				</form> 

				<form id="registerForm" action="register.php" method="POST">
					
					<h2>Create your free account</h2>
					
					<p>	
						<?php echo $account->getError("Your username must be 5 to 25 characters"); ?>
						<?php echo $account->getError("This username is already taken"); ?>
						<label for="username">Username</label>
						<input id="username" name="username" type="text" placeholder="e.g John123" value="<?php getInputValue('username') ?>" required></input>
					</p>

					<p>	
						<?php echo $account->getError("Your first name must be 2 to 25 characters"); ?>
						<label for="firstName">First Name</label>
						<input id="firstName" name="firstName" type="text" placeholder="e.g John" value="<?php getInputValue('firstName') ?>" required></input>
					</p>

					<p>	
						<?php echo $account->getError("Your last name must be 2 to 25 characters"); ?>
						<label for="lastName">Last Name</label>
						<input id="lastName" name="lastName" type="text" placeholder="e.g John Cena" value="<?php getInputValue('lastName') ?>" required></input>		
					</p>

					<p>	
						<?php echo $account->getError("Your email don't match"); ?>
						<?php echo $account->getError("Your email invalid"); ?>
						<?php echo $account->getError("This email is already taken"); ?>
						<label for="email">Email</label>
						<input id="email" name="email" type="email" placeholder="e.g John@hotmail.com" value="<?php getInputValue('email') ?>" required></input>
					</p>

					<p>
						<label for="email2">Confirm email</label>
						<input id="email2" name="email2" type="email" placeholder="e.g John@hotmail.com" value="<?php getInputValue('email2') ?>" required></input>
					</p>
					
					<p>	
						<?php echo $account->getError("Your password can only be numbers and letters"); ?>
						<?php echo $account->getError("Your passwords don't match"); ?>
						<?php echo $account->getError("Your password must be 5 to 25 characters"); ?>
						<label for="password">Password</label>
						<input id="password" name="password" type="password" placeholder="Your password" value="<?php getInputValue('password') ?>" required></input>
					</p>

						<p>
						<label for="password2">Confirm password</label>
						<input id="password2" name="password2" type="password" placeholder="Retype your password" value="<?php getInputValue('firstName2') ?>" required></input>
					</p>

					<button type="submit" name="registerButton">SIGN UP</button>

					<div class="accountText">
						<span id="hideRegister">Already have account? Log In here</span>
					</div>
				</form>
			</div><!-- End of Input Container -->
			<div id="hero-text-box">
				<h1>Listen to great music, right now</h1>
				<h2>Great Music to listen for free</h2>
				<ul>
					<li>Discover music you'll fall in love with</li>
					<li>Make your own playlists</li>
					<li>Follow artists to keep up to date</li>
				</ul>
			</div><!-- End of Hero Text box --
		</div> <!-- End of Login Container -->
	</div> <!-- End of background -->

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="assets/js/register.js" type="text/javascript"></script>
	
	<?php
		if(isset($_POST['registerButton'])) {
			echo  '<script>
						$(document).ready(function(){	

						$("#loginForm").hide();
						$("#registerForm").show();
					});
					</script>';
		}
		else {
			echo  '<script>
						$(document).ready(function(){	

						$("#loginForm").show();
						$("#registerForm").hide();
					});
					</script>';
		}
	?>

	<script>
		
	</script>

</body>
</html>




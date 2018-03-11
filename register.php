<?php 
	include("includes/config.php");
	include("includes/classes/Account.php");

	//Create a new instance of Account object into $account
	$account = new Account();

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
	<title>Welcome to VoiseM</title>
	<!--[if IE]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
</head>
<body>

	<form  id="loginForm" action="register.php" method="POST">
		
		<h2>Login to your account</h2>

		<p>
			<label for="loginUsername">Username</label>
			<input id="loginUsername" name="loginUsername" type="text" placeholder="e.g John123" required></input>
		</p>
		
		<p>
			<label for="loginPassword">Password</label>
			<input id="loginPassword" name="loginPassword" type="password" placeholder="Your password" required></input>
		</p>

		<button type="submit" name="loginButton">LOG IN</button>

	</form>

	<form id="registerForm" action="register.php" method="POST">
		
		<h2>Create your free account</h2>
		
		<p>	
			<?php echo $account->getError("Your username must be 5 to 25 characters"); ?>
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

	</form>

</body>

</html>


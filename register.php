<?php 

	function sanitazeFormUsername($inputText) {
		$inputText = strip_tags($inputText);
		$username = str_replace(" ", "", $inputText);
		return $inputText;
	}

	function sanitazeFormPassword($inputText) {		
		$inputText = strip_tags($inputText);
		$username = str_replace(" ", "", $inputText);
		return $inputText;
	}

	function sanitazeFormString($inputText) {
		$firstName = strip_tags($firstName);
		$firstName = str_replace(" ", "", $firstName);
		$firstName = ucfirst(strtolower($firstName)); //Convert all the string to lower case first then convert first character to uppercase
		return $inputText;
	}
	
	if(isset($_POST['loginButton'])) {
		//Login button was pressed 
	}

	if(isset($_POST['registerButton'])) {
		//Register Button was pressed
		$username = sanitazeFormUsername($_POST['username']);
		$firstName = sanitazeFormString($_POST['firstName']);
		$lastName = sanitazeFormString($_POST['lastName']);
		$email = sanitazeFormString($_POST['email']);
		$email2 = sanitazeFormString($_POST['email2']);
		$password = sanitazeFormPassword($_POST['password']);
		$password2 = sanitazeFormPassword($_POST['password2']);
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
			<label for="username">Username</label>
			<input id="username" name="username" type="text" placeholder="e.g John123" required></input>
		</p>

		<p>
			<label for="firstName">First Name</label>
			<input id="firstName" name="firstName" type="text" placeholder="e.g John" required></input>
		</p>

		<p>
			<label for="lastName">Last Name</label>
			<input id="lastName" name="lastName" type="text" placeholder="e.g John Cena" required></input>
		</p>

		<p>
			<label for="email">Email</label>
			<input id="email" name="email" type="email" placeholder="e.g John@hotmail.com" required></input>
		</p>

		<p>
			<label for="email2">Email</label>
			<input id="email2" name="email2" type="email" placeholder="e.g John@hotmail.com" required></input>
		</p>
		
		<p>
			<label for="password">Password</label>
			<input id="password" name="password" type="password" placeholder="Your password" required></input>
		</p>

			<p>
			<label for="password2">Confirm password</label>
			<input id="password2" name="password2" type="password" placeholder="Retype your password" required></input>
		</p>

		<button type="submit" name="registerButton">SIGN UP</button>

	</form>

</body>

</html>

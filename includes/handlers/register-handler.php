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
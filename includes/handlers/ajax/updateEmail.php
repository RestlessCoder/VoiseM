<?php

	include("../../config.php");

	if(!isset($_POST['username'])) {
		echo "Could not set username";
		exit();
	}

	if(isset($_POST['email']) && $_POST['email'] !== "") {
		
		$username = $_POST['username']; 
		$email = $_POST['email']; 

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Not valid email address";	
			exit();
		}

		// Add username != '$username' because we only want to check the email but not the username
		$emailCheck = mysqli_query($con, "SELECT email FROM users WHERE email='$email' AND username != '$username'");  
		if(mysqli_num_rows($emailCheck) > 0) {
			echo "Email is already in used";
			exit();
		}

		$updateEmail = mysqli_query($con, "UPDATE users SET email = '$email' WHERE username='$username'");
		echo "Your Email has been change succesfully";

	}else {
		echo "Must provide an email address";
	}

?>
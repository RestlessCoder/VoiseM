<?php

	include("../../config.php");

	if(!isset($_POST['username'])) {
		echo "Could not set username";
		exit();
	}

	if(!isset($_POST['oldPassword']) || !isset($_POST['newPassword1'])  || !isset($_POST['newPassword2'])) {
		echo "Not all passwords have been set";
		exit();
	}

	if($_POST['oldPassword'] == "" || $_POST['newPassword1'] == "" || $_POST['newPassword2'] == "") {
		echo "Please fill in all fields";
		exit();
	}

	$username = $_POST['username']; {}
	$oldPassword = $_POST['oldPassword']; 
	$newPassword1 = $_POST['newPassword1']; 
	$newPassword2 = $_POST['newPassword2']; 
	
	$oldMd5 = md5($oldPassword);

	$passwordCheck = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$oldMd5'");

	// Check if the old password match with the database
	if(mysqli_num_rows($passwordCheck) != 1) {
		echo "Password is incorrect";
		exit();
	}

	if($newPassword1 != $newPassword2) {
		echo "Your new password do not match";
		exit();
	}

	if($oldPassword == $newPassword1) {
		echo "Cannot reused old password";
		exit();
	}

	if(preg_match('/[^A-Za-z0-9]/', $newPassword1)) {
		echo "Your password can only be numbers and letters";
		exit();
	}

	if(strlen($newPassword1) > 25 || strlen($newPassword2) < 5) {
		echo "Your password must be 5 to 25 characters";
		exit();
	}

	$newMd5 = md5($newPassword1);

	$updatePassword = mysqli_query($con, "UPDATE users SET password='$newMd5' WHERE username='$username'");
	echo "Your password has been change succesfully"

?>
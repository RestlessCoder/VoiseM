<?php
	if(isset($_POST['loginButton'])) {
		//Login button was pressed 
		$username = $_POST['loginUsername'];
		$password = $_POST['loginPassword'];

		$result = $account->login($username, $password);

		// Login Succesful
		if($result) {
			$_SESSION['userLoggedIn'] = $username;
			header('Location: index.php');
		}
	}
?>
<?php include('includes/includedFile.php') ?>

<div class="entityInfo">
	<div class="centerSection">
		<div class="userInfo">
			<h1><?php echo $userLoggedIn->getFirstAndLastName(); ?></h1>
		</div>
		
		<div class="buttonItems">
			<button class="transparentButton" onclick="openPage('updateDetails.php')">User Details</button>
			<button class="transparentButton" onclick="logout()">LOGOUT</button>
		</div>
	</div>
</div>
<?php include('includes/includedFile.php'); ?>

<div class="userDetails">
	<div class="containerItems">
		<h2>Email</h2>
		<input type="email" class="email" name="email" value="<?php echo $userLoggedIn->getEmail() ?>" placeholder="Enter Email"></input>
		<span class="errorMessage"></span>
		<button class="transparentButton" onclick="updateEmail('email')">Save</button>
	</div>
	<div class="containerItems">
		<h2>Password</h2>
		<input type="password" class="oldPassword" name="oldPassword" placeholder="Current Password"></input>
		<input type="password" class="newPassword1" name="newPassword1" placeholder="New Password"></input>
		<input type="password" class="newPassword2" name="newPassword2" placeholder="Confirm Password"></input>
		<span class="errorMessage"></span>
		<button class="transparentButton" onclick="updatePassword('oldPassword', 'newPassword1', 'newPassword2')">Save</button>
	</div>
</div>
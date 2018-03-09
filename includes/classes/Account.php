<?php

	class Account {

		private $errorArray;

		// When create variable new Account and set our errorArray variable to a empty array
		public function  __construct() {
			$this->errorArray = array();
		} 

		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validatePasswords($pw, $pw2);

			if(empty($this->errorArray)) {
				//Insert into db
				return true;
			}
			else {
				return false;
			}

		}

		//This function is to check the error that we pass in is in the array if its not in the array return empty string
		public function getError($error) {
			if(!in_array($error, $this->errorArray)) {
				$error = "";
			}
			return "<span class='errorMessage'>$error</span>";
		}

		private function validateUsername($un) {

			if(strlen($un) > 25 || strlen($un) < 5) {
				array_push($this->errorArray, "Your username must be 5 to 25 characters");
				return; // Put in return there when we dont want to execute this function if we find any errors 
			}
		}	

		private function validateFirstName($fn) {

			if(strlen($fn) > 25 || strlen($fn) < 2) {
				array_push($this->errorArray, "Your first name must be 2 to 25 characters");
				return;  
			}
			
		}

		private function validateLastName($ln) {

			if(strlen($ln) > 25 || strlen($ln) < 2) {
				array_push($this->errorArray, "Your last name must be 2 to 25 characters");
				return; 
			}

		}

		private function validateEmails($em, $em2) {
			
			if($em != $em2) {
				array_push($this->errorArray, "Your email don't match");
				return;
			}

			// This is use to manual validate the e.g .com/.co.uk because it doesnt check in HTML 
			if(!filter_var($em, FILTER_VALIDATE_EMAIL)) {
				array_push($this->errorArray, "Your email invalid");
				return;
			}

		}

		private function validatePasswords($pw, $pw2) {

			if($pw != $pw2) {
				array_push($this->errorArray, "Your passwords don't match");
				return;
			}

			//To find out more: https://www.phpjabbers.com/php-validation-and-verification-php27.html
			//Password must be in number and word characters(uppercase/lowercase) only
			if(preg_match('/[^A-Za-z0-9]/', $pw)) {
				array_push($this->errorArray, "Your password can only be numbers and letters");
				return;
			}

			if(strlen($pw) > 25 || strlen($pw) < 5) {
				array_push($this->errorArray, "Your password must be 5 to 25 characters");
				return;
			}
		}

	}
?>

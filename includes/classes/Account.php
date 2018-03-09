<?php
	class Account {

		public function __constructor() {

		} 

		public function register($un, $fn, $ln, $em, $em2, $pw, $pw2) {
			$this->validateUsername($un);
			$this->validateFirstName($fn);
			$this->validateLastName($ln);
			$this->validateEmails($em, $em2);
			$this->validateEmails($pw, $pw2);
		}

		private function validateUsername($un) {
		}	

		private function validateFirstName($fn) {
			
		}

		private function validateLastName($ln) {
			
		}

		private function validateEmails($em, $em2) {
			
		}


		private function validatePasswords($pw, $pw2) {
			
		}

	}
?>

<?php


	class Auth{
		static function isLogged(){
			if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['Login']) && isset($_SESSION['Auth']['pwd'])){
				return true;
			} else {
				return false;
			}
		}

		static function hasRole(){
			if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['role']) && !empty($_SESSION['Auth']['role'])){
				return true;
			} else {
				return false;
			}
		}

		static function isAdmin(){
			if(isset($_SESSION['Auth']) && isset($_SESSION['Auth']['role']) && $_SESSION['Auth']['role'] == "*"){
				return true;
			} else {
				return false;
			}
		}
	}



?>
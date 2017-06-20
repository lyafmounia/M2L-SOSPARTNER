<?php

	function debug ($variable){
		echo '<pre>' . print_r($variable, true) . '</pre>';
	}

	function str_random($length){
		 $alphabet = "0123456789azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN";
    	return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
	}

	function logged_only (){

		if(session_status() == PHP_SESSION_NONE){
      	session_start();
      		}

		if(isset($_SESSION['auth'])){
		$_SESSION['flash']['danger'] = "Vous n'avez pas le droit d'accéder à cette page.";
		header('location : login.php');
		exit();
		}	
	}

	 /*public function Login($email, $password)
	 
	 	try{
	 		 $req = $pdo->prepare('SELECT * FROM students WHERE (email = :email) AND password = :password');
	 		 $req->bindParam("email", $email, PDO::PARAM_STR);
	 		 $req->execute();
	 		 if ($req->rowCount() > 0) {
	 		 	return $req->FETCH(PDO::FETCH_OBJ);
	 		 }

	 	} catch (PDOExeption $e){
	 		exit($e->getMessage());
	 	}*/
	 



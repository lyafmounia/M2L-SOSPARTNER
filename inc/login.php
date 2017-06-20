

<?php
session_start();


	if(!empty($_POST) && !empty($_POST['email']) && !empty($_POST['password'])){
		
		require_once'db.php';
		require_once 'functions.php';

		$email     = $_POST['email']; 
		$password  = $_POST['password']; 
		

		$req = $pdo->prepare("SELECT * FROM partners WHERE email = '".$email."' AND password= '".md5($password)."' ");
		
		/*$req->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
		$req->bindParam(':password', $_POST['password'], PDO::PARAM_STR);*/
		$req->execute();
		$user = (object)$req->fetch(); 
		
	
		if(md5($_POST['password']) == $user->password) {
				$_SESSION['auth'] = $user;
				$_SESSION['flash']['success'] = 'Vous êtes maintenant connecté';
				header('location: account.php');
				exit();
		}else{

			$_SESSION['flash']['danger'] = 'Identifiant ou mot de passe incorrecte';
		}
	}
?>

<?php 	require 'header.php'; 

//print_r($_SESSION);
//print_r($_POST);
?>


	<h1 class="well">Se connecter</h1>

	

<form action="" method="POST" novalidate="false">

	<div class="form-group">

		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" >
		
	</div>


	<div class="form-group">

		<label for="password">Mot de passe</label>
		<input type="password" name="password" class="form-control" >
		
	</div>


	<button type="submit" class="btn btn-primary">Se connecter</button>
	

</form>






<?php require 'footer.php'; ?>

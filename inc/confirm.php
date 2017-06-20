<?php

	$user_id = $_GET['id_s'];
	$token = $_GET['token'];
	
		require 'db.php';
	
	$req = $pdo->prepare('SELECT * FROM students WHERE id_s = ?');
	$req->execute([$user_id]);
	$user = $req->fetch();
	
	session_start();

	if($user && $user->confirmation_token == $token ){
	    $pdo->prepare('UPDATE students SET confirmation_token = NULL, confirmed_at = NOW() WHERE id_s = ?')->execute([$user_id]);
	    $_SESSION['flash']['success'] = 'Votre compte a bien été validé';
	    $_SESSION['auth'] = $user;
	    header('Location: account.php');
	}else{
	    $_SESSION['flash']['danger'] = "Ce token n'est plus valide";
	    header('Location: login.php');
	}

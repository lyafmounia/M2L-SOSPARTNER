<?php

 require_once 'functions.php';
 	session_start();

	if (!empty($_POST)) {

		/*foreach($_POST as $key=> $value){

			$$key= sanatise($value);
		}*/

		
		$errors = array();
		require_once 'db.php';

		if(empty($_POST['name'])||!preg_match('/^[a-zA-Z0-9_]*$/', $_POST['name'])){
			$errors['name'] = "Vous Nom n'est pas valide (alphanumérique). ";
		}

		if(empty($_POST['surname'])|| !preg_match('/^[a-zA-Z0-9_]*$/', $_POST['surname'])){
			$errors['surname'] = "Vous Prénom n'est pas valide (alphanumérique). ";
		}

		

		if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){ // pour vzrifier le format du mail a changer
			$errors['email'] = "Votre email n'est pas valide !";	
		}else{
			$req = $pdo->prepare('SELECT id_p FROM partners WHERE email = ?'); 
			$req -> execute([$_POST['email']]);
			$user = $req->fetch();
			if ($user) {
				$errors['email'] = 'Cet email est déjà utilisé pour un autre compte.';
			}
		}

		if (empty($_POST['password']) || $_POST['password'] != $_POST['password_confirm']) {
			$errors ['password'] = "Vous devez entrer un mot de passe valide !";
		}

		if(empty($errors)){
				//"INSERT INTO students SET name = ?, surname = ?, degree = ?, degree_date = ?, email = ?, password = ?, confirmation_token = ?"
			//([$_POST['name'], $_POST['surname'], $_POST['degree'], $_POST['degree_date'], $_POST['email'], $password, $token]);


			$req = $pdo->prepare("INSERT INTO partners SET name = ?, surname = ?, email = ?, sport = ?, arrondissement = ?, password = ?");
    		$password = md5($_POST['password']);
    		$token = str_random(60);
     		$req->execute([$_POST['name'], $_POST['surname'], $_POST['email'], $_POST['sport'], $_POST['arrondissement'], $password]);
   			$user_id = $pdo->lastInsertId();
    		//mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/alumni1/inc/confirm.php?id_s=$user_id&token=$token");
    		$_SESSION['flash']['success'] = 'Vous etes inscrit, vous pouvez maintenant vous connecter';
    	
    	header('Location: login.php');
   
    exit();




		    // On enregistre les informations dans la base de données 
		   /* $req = $pdo->prepare("INSERT INTO students SET name = ?, surname = ?, degree = ?, degree_date = ?, email = ?, password = ?, confirmation_token = ?");
		    // On ne sauvegardera pas le mot de passe en clair dans la base mais plutôt un hash
		    $password = md5($_POST['password']);
		    // On génère le token qui servira à la validation du compte 
		    $token = str_random(60);
		    
		    $req->execute([$_POST['name'], $_POST['surname'], $_POST['degree'], $_POST['degree_date'], $_POST['email'], $password, $token]);
		    $user_id = $pdo->lastInsertId();
		    // On envoit l'email de confirmation
		    if(mail($_POST['email'], 'Confirmation de votre compte', "Afin de valider votre compte merci de cliquer sur ce lien\n\nhttp://localhost/alumni1/inc/confirm.php?id_s=$user_id&token=$token")) {
 
		    	echo 'message envoyé';
		    } else{

		    	echo 'envoi du message impossible'. $_POST['email']; 
		    }exit();
		    // On redirige l'utilisateur vers la page de login avec un message flash
		    $_SESSION['flash']['success'] = 'Un email de confirmation vous a été envoyé pour valider votre compte';
		    header('Location: login.php');
		    exit();  */

}

		

		
	}


		

?>

<?php require 'header.php'; ?>



<?php if (!empty($errors)): ?> 
	
	<div class="alert alert-danger">
		<p> Vous n'avez pas rempli le formulaire correctement </p>

			<ul>
			<?php foreach($errors as $error): ?>
				<li><?= $error; ?></li> 
			<?php endforeach; ?>
			</ul>			
	</div>

 <?php endif; ?>

<div class="container">
	
	<h1 class="well">S'inscrire</h1>

</div>


<form  class="col-lg-6"  action="" method="POST">

<fieldset class="well">
	<div class="col-sm-12">
		<div class="row">
			<div class="col-sm-6 form-group">
		<label for="name">Nom</label>
		<input type="text" name="name"  class="form-control">
	</div>

	<div class="col-sm-6 form-group">
		<label for="surname">Prénom</label>
		<input type="text" name="surname"  class="form-control">
	</div>
	</div>


	<div class="form-group">
		<label for="email">Email</label>
		<input type="email" name="email" class="form-control" >
	</div>

	<div class="form-group">
		<label for="sport">Votre sport</label>
		<select name="sport" id ="degree" class="form-control">
				<option value="1">Football </option>
				<option value="2">Basketball</option>
				<option value="3">Tennis </option>
		</select>
	</div>

	<div class="form-group">
		<label for="arrondissement">Votre arrondissement</label>
		<select name="arrondissement" id ="degree" class="form-control"  >
				<option value="1">75005 </option>
				<option value="2">75012</option>
				<option value="3">75016 </option>
				<option value="3">75018 </option>
				<option value="3">75020 </option>
		</select>
	</div>


	<div class="form-group">

		<label for="password">Mot de passe</label>
		<input type="password" name="password"  class="form-control">
		
	</div>

	<div class="form-group">

		<label for="password_confirm">Confirmer le mot de passe</label>
		<input type="password" name="password_confirm"  class="form-control">
		
	</div>

	<button type="submit" class="btn btn-primary">M'inscrire</button>

	</div>
	

</form>
</fieldset>
<?php require 'footer.php' ; ?>


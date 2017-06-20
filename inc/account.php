<?php 
	session_start();
	require_once'functions.php';

	require_once'db.php';

    require_once'header.php';


?>

	<div align="center">

		<h1>Bienvenue <?php echo $_SESSION['auth']->name; ?></h1></div>

		<br><br><br>

		<div class="row">
			<div class="col-lg-3">
				<a href="#" class="btn btn-info" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-minus"></span>Afficher la liste des partenaires</a>
				<!-- Modal -->
					  <div class="modal fade" id="myModal" role="dialog">
					    <div class="modal-dialog">
					    
					      <!-- Modal content-->
					      <div class="modal-content">
					        <div class="modal-header">
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					          <h4 class="modal-title">Modal Header</h4>
					        </div>
					        <div class="modal-body">

					        <?php 
		
					        	$req = $pdo->prepare("SELECT * FROM partners"); 	
					           	$req->execute();
					          	$req->fetchAll();
					        	//On affiche chaque entrée une à une
					        	while ($donnees = $req->fetch()) {
					        		var_dump($req);die;

					         ?>
					         <p>
					         	Nom : <?php echo $donnees['name'];  ?><br>
					         	Prénom : <?php echo $donnees['surname'];  ?><br>
					         	Sport : <?php echo $donnees['sport'];  ?><br>
					         	Localisation : <?php echo $donnees['arrondissement'];  ?><br>

					         </p>
					         <?php
					     }
					     
					     $req->closeCursor(); //termine le traitement de la requete
					     ?>
					          












					        </div>
					        <div class="modal-footer">
					          <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
					        </div>
					      </div>
					      
					    </div>
					  </div>
  
			</div>

			<div class="col-lg-3">
				<a href="#" class="btn btn-success"><span class="glyphicon glyphicon-minus"></span>Rechercher un partenaire</a>
			</div>
			<div class="col-lg-3">
				<a href="#" class="btn btn-warning"><span class="glyphicon glyphicon-minus"></span>Modifier mes informations</a>
			</div>
			<div class="col-lg-3">
				<a href="#" class="btn btn-danger"><span class="glyphicon glyphicon-minus"></span>Supprimer mon compte</a>
			</div>
		</div>



<?php require 'footer.php'; ?>

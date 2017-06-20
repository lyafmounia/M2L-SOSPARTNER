<?php
  
   if(session_status() == PHP_SESSION_NONE){
      session_start();
  }

?>




<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
  
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SOS PARTNERS</title>

    <link href="/sospartner/css/app.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  
  </head>

  <body>

    <nav class="navbar navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">SOS partners</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SOS PARTNERS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">

              <?php if(isset($_SESSION['auth'])): ?>

                <li><a href="logout.php">Se déconnecter</a></li>

              <?php endif; ?>


            <li><a href="register.php">S'inscrire</a></li>
            <li><a href="login.php">Se connecter</a></li>

           
          
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <div class="container">


      <?php if(isset($_SESSION['flash'])) : ?>
        <?php foreach($_SESSION['flash'] as $type =>$message): ?>

            <div class="alert alert-<?= $type; ?>">
              
               <?= $message; ?>
            
            </div>
        
        <?php endforeach; ?>
          <?php unset($_SESSION['flash']); ?>
      <?php endif; ?>

     


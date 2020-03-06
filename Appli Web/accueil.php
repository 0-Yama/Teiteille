<?php

  session_start();

  require_once __DIR__ . '\db.php';


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Accueil - La Teiteille</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<?php include('header.php'); ?>

<body>
  <div class="container-fluid main">
    <div class="row">

      <div class="col-sm-2 navig">

        <nav>
          <ul class="nav nav-pills nav-stacked">
            <li><a href="inscription.php">Inscription</a></li>
            <li> <a href="connexion.php">Connexion</a> </li>
            <li><a href="devis.php">Demande de devis</a></li>
            <li><a href="profile.php">Votre profile</a></li>
          </ul>
        </nav>
      </div>

      <div class="col-sm-10 main2">

        <div class="col-sm-5 input-group src-bar">
          <input type="text" class="form-control" name="search" placeholder="Rechercher...">
          <div class="input-group-btn">
            <button class="btn btn-default" type="submit">
              <i class="glyphicon glyphicon-search"></i>
            </button>
          </div>
        </div>

        <div class="img">
          <h1>Accueil</h1>
          <?php
          if(isset($_SESSION['mail'])){
            echo "Connecté";
          }else {
            echo "Pas connecté";
          }
          ?>
        </div>

      </div>
    </div>
  </div>
</body>

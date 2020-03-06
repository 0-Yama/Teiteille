<?php

  session_start();

  require_once __DIR__ . '\db.php';


 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Devis - La Teiteille</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<?php include('header.php'); ?>

<body>
  <div class="container-fluid main">
    <h1>Demande de devis</h1>
    <form action="verif_devis.php" method="post">

      <input type="number" name="duration" class="form-control" placeholder="Durée"><br>

      <input type="number" name="frequency" class="form-control" placeholder="Fréquence"><br>

      <input type="text" name="service_type" class="form-control" placeholder="Type de service"><br>

      <input type="text" name="information" class="form-control" placeholder="Informations complémentaires"><br>

      <button class="btn btn-form" type="submit" name="devis">Envoyer</button><br><br>

    </form>

    <a href="accueil.php">Retour</a>
  </div>
</body>

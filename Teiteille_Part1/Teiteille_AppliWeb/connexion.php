<?php

  session_start();

  require_once __DIR__ . '\db.php';
  require_once __DIR__ . '\verif_inscription.php';

 ?>

<!DOCTYPE html>
<html>
<head>
	<title>Connexion - La Teiteille</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<?php include('header.php'); ?>

<body>
  <div class="container-fluid main">
    <h1>Connexion</h1>
    <div class="container formulaire">
      <form action="verif_connexion.php" method="post">

        <?php
          if (isset($_GET['error']) && $_GET['error']=='missing') {
        ?>
            <div><p>Veuillez renseigner tous les champs.</p></div>
        <?php
          }
          if(isset($_GET['error']) && $_GET['error']=='invalid') {
        ?>
            <div><p>Mail ou mot de passe incorrect.</p></div>
        <?php
          }
        ?>

        <input type="email" name="mail" class="form-control" placeholder="Adresse mail"><br><br>

        <input type="password" name="pswd" class="form-control" placeholder="Mot de passe"><br><br>

        <button class="btn btn-form" type="submit" name="connexion">Valider</button><br><br>

      </form>
    </div>

    <a href="accueil.php">Retour</a>
  </div>
</body>
</html>

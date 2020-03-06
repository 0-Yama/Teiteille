<?php


  require_once __DIR__ . '\db.php';

  /*
  $req = $bdd->query('SELECT * FROM member');

  var_dump($req->fetchObject());
  */

?>

<!DOCTYPE html>
<html>
<head>
	<title>Inscription - La Teiteille</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<?php include('header.php'); ?>

<body>
  <div class="container-fluid main">
    <h1>Inscription</h1>
    <div class="container formulaire">
      <form action="verif_inscription_bis.php" method="post">

        <?php
          if (isset($_GET['error']) && $_GET['error']=='missing') {
        ?>
            <div><p>Veuillez renseigner tous les champs.</p></div>
        <?php
          }
        ?>

        <input type="email" name="mail" class="form-control" placeholder="Adresse mail"><br>

        <input type="text" name="name" class="form-control" placeholder="Nom"><br>

        <input type="text" name="city" class="form-control" placeholder="Ville"><br>

        <input type="text" name="street" class="form-control" placeholder="Rue"><br>

        <input type="number" name="number_street" class="form-control" placeholder="Numéro de rue"><br>

        <input type="number" name="phone_number" class="form-control" placeholder="N° de téléphone"><br>

        <input type="password" name="pswd" class="form-control" placeholder="Mot de passe"><br>

        <button class="btn btn-form" type="submit" name="inscription">Valider</button><br><br>

      </form>
    </div>

    <a href="accueil.php">Retour</a>
  </div>

</body>

</html>

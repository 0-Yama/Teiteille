<?php

  session_start();

  require_once __DIR__ . '\db.php';

  $q = 'SELECT * FROM member WHERE mail=?';
  $infos = $bdd->prepare($q);
  $infos->execute(array($_SESSION['mail']));


 ?>


<!DOCTYPE html>
<html>
<head>
	<title>Profile - La Teiteille</title>
	<meta charset="utf-8">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
</head>

<?php include('header.php'); ?>

<body>
  <div class="container-fluid main bluebg">
    <h1>Profile</h1>

    <?php while($a = $infos->fetch()){ ?>
    <div>
      <ul class="profile">
        <li>Nom : <?= $a['name']?></li>
        <li>Mail : <?= $a['mail']?></li>
        <li>Adresse : <?= $a['number_street']?> <?= $a['street']?>, <?= $a['city']?></li>
        <li>N° de téléphone : +33<?= $a['phone_number']?></li>

      </ul>
    </div>
  <?php } ?>


    <a href="accueil.php">Retour</a>
  </div>
</body>
</html>

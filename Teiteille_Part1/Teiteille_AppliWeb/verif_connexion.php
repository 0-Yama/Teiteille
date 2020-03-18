<?php

  session_start();

  require_once __DIR__ . '\db.php';

  $valid = true;

  if(isset($_POST['connexion'])){

    if(empty($_POST['mail']) || empty($_POST['pswd'])){
      $valid = false;
      $er_msg = "Veuillez renseigner tous les champs";
      header('Location:connexion.php?error=missing');
      exit;
    }

    $pswd = crypt($_POST['pswd'],'$5$rounds=5000$s6yxfg248sd2e315w$');
    $q = 'SELECT * FROM member WHERE mail=? AND pswd=?';
    $req = $bdd->prepare($q);
    $req->execute(array(
      $_POST['mail'],
      $pswd
    ));
    $req = $req->fetch();

    if ($req['mail'] == "") {
      $valid = false;
      header('Location:connexion.php?error=invalid');
    }

    if ($valid == true) {
      $_SESSION['mail'] = $req['mail'];

      header('Location:accueil.php');
    }


  }


?>

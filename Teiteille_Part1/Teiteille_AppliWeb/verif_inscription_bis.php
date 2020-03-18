<?php

  session_start();

  require_once __DIR__ . '\db.php';

  $valid = true;

  if(isset($_POST['inscription'])){

    if(!isset($_POST['mail']) || empty($_POST['mail']) ||
        !isset($_POST['name']) || empty($_POST['name']) ||
        !isset($_POST['city']) || empty($_POST['city']) ||
        !isset($_POST['street']) || empty($_POST['street']) ||
        !isset($_POST['number_street']) || empty($_POST['number_street']) ||
        !isset($_POST['phone_number']) || empty($_POST['phone_number']) ||
        !isset($_POST['pswd']) || empty($_POST['pswd'])){

          $valid = false;
          header('Location:inscription.php?error=missing');
          exit;
        }
      header('Location:inscription.php');


  }

?>

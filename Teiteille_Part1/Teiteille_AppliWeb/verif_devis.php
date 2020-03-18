<?php


  require_once __DIR__ . '\db.php';

  if(isset($_POST['frequency']) && !empty($_POST['frequency']) &&
      isset($_POST['duration']) && !empty($_POST['duration']) &&
      isset($_POST['service_type']) && !empty($_POST['service_type']))
      {
        $q = 'INSERT INTO quote (frequency,duration,service_type,information)VALUES (:frequency,:duration,:service_type,:information)';
        $req = $bdd->prepare($q);
        $req->execute(array(
          'frequency'=>$_POST['frequency'],
          'duration'=>$_POST['duration'],
          'service_type'=>$_POST['service_type'],
          'information'=>$_POST['information']
        ));

        header('Location:accueil.php');
        exit;
      }



  ?>

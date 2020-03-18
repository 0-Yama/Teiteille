<?php


  require_once __DIR__ . '\db.php';

  if(isset($_POST['mail']) && !empty($_POST['mail']) &&
      isset($_POST['name']) && !empty($_POST['name']) &&
      isset($_POST['city']) && !empty($_POST['city']) &&
      isset($_POST['street']) && !empty($_POST['street']) &&
      isset($_POST['number_street']) && !empty($_POST['number_street']) &&
      isset($_POST['phone_number']) && !empty($_POST['phone_number']) &&
      isset($_POST['pswd']) && !empty($_POST['pswd']))
      {
        $pswd = crypt($_POST['pswd'],'$5$rounds=5000$s6yxfg248sd2e315w$');

        $q = 'INSERT INTO member (mail,name,city,street,number_street,phone_number,pswd)VALUES (:mail,:name,:city,:street,:number_street,:phone_number,:pswd)';
        $req = $bdd->prepare($q);
        $req->execute(array(
          'mail'=>$_POST['mail'],
          'name'=>$_POST['name'],
          'city'=>$_POST['city'],
          'street'=>$_POST['street'],
          'number_street'=>$_POST['number_street'],
          'phone_number'=>$_POST['phone_number'],
          'pswd'=>$pswd
        ));

        header('Location:accueil.php');
        exit;
      }



  ?>

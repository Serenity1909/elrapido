<?php
session_start();
require_once '../ReUsedCode/config.php';

    if(!empty($_POST['email']) && !empty($_POST['password'])){
        // htmlspecialchars -> read special char in html
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);

        $email = strtolower($email); 

        // check if email exist in db
        // if there is already an email add 1 to $row
        $check = $bdd ->prepare('SELECT pseudo,email,password,token FROM player WHERE email =?');
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

       if($row > 0)
       {
           // if email is in right format
           if(filter_var($email, FILTER_VALIDATE_EMAIL))
           {
               // if is the right password
               if(password_verify($password, $data['password']))
               {
                   // create session and go to PlayNow.php
                   $_SESSION['user'] = $data['token'];

                   $up = $bdd -> prepare ('UPDATE player SET statut = "online" WHERE token = :token');
                   $up->execute(array(
                    "token" => $_SESSION['user']
                    ));

                   header('Location: ../PlayNow.php');
                   die();
                // relocate and return a fault alert (login_err)
               }else{ header('Location: ../index.php?login_err=password'); die(); }
           }else{ header('Location: ../index.php?login_err=email'); die(); }
       }else{ header('Location: ../index.php?login_err=already'); die(); }
    // if form is send without data => relocate
    }else{ header('Location: ../index.php'); die();}
       
?>
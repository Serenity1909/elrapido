<?php
    session_start();

    require_once "../ReUsedCode/config.php";

    $up = $bdd -> prepare ('UPDATE player SET statut = "offline" WHERE token = :token');
    $up->execute(array(
     "token" => $_SESSION['user']
     ));
     
    session_unset();

    session_destroy();
    header('Location:../index.php');
    die();
?>
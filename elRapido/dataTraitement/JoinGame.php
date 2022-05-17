<?php
    session_start();
    require_once '../ReUsedCode/config.php'; 

    $req = $bdd->prepare('SELECT * FROM player WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $insert = $bdd->prepare("UPDATE party 
                                 SET tokenPlayer2 = '$data[9]',
                                     PseudoPlayer2 = '$data[2]'
                                 WHERE tokenParty = '".$_GET['tokenP']."'");
    $insert->execute();

    header('Location:../inGame.php'); die();
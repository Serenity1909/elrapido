<?php
    session_start();
    require_once '../ReUsedCode/config.php';

    $req = $bdd->prepare('SELECT * FROM player WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $token = $data['token'];

    $join2 = $bdd->prepare("SELECT tokenPlayer2, PseudoPlayer2 FROM party WHERE tokenPlayer1 = '$token'");
    $join2->execute();
    $dataJoin2 = $join2->fetch();

    // check if token and pseudo player 2 is initialize in DB
    if($dataJoin2[0] != null && $dataJoin2[1] != ""){
        echo "Join";
    }
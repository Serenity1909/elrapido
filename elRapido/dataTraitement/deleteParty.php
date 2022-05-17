<?php
    session_start();
    require_once '../ReUsedCode/config.php';

    $req = $bdd->prepare('SELECT * FROM player WHERE token = ?');
    $req -> execute(array($_SESSION['user']));
    $data = $req->fetch();

    $token = $data['token'];

    $sql = $bdd->prepare("DELETE FROM party WHERE tokenPlayer1 = '$token'");
    $sql -> execute();

    echo "1";
?>
<?php
    session_start();
    require_once '../ReUsedCode/config.php';

    $token = $_SESSION['user'];

    $reqParty = $bdd->prepare("SELECT * FROM party WHERE tokenPlayer1 ='$token' OR tokenPlayer2 = '$token'");
    $reqParty->execute();
    $dataParty = $reqParty->fetch(PDO::FETCH_ASSOC);

    print(json_encode(array($dataParty, $token)));
?>
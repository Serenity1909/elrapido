<?php
    require_once "../ReUsedCode/config.php";

    $tokenPlayer = $_GET['tokenplayer'];
    $tokP = $_GET['tokP'];

    $reqParty = $bdd->prepare("SELECT * FROM party WHERE tokenParty = '$tokP'");
    $reqParty->execute();
    $dataParty = $reqParty->fetch(PDO::FETCH_ASSOC);


    if($tokenPlayer === $dataParty['tokenPlayer1']){
        $insert = $bdd->prepare("UPDATE party SET readyPlayer1 = '1' WHERE tokenParty = '$tokP'");
        $insert->execute();
        echo "1";
    } elseif ($tokenPlayer === $dataParty['tokenPlayer2']){
        $insert = $bdd->prepare("UPDATE party SET readyPlayer2 = '1' WHERE tokenParty = '$tokP'");
        $insert->execute();
        echo "2";
    }
?>
<?php
    require_once "../ReUsedCode/config.php";

    $tokP = $_GET['tokP'];

    $reqParty = $bdd->prepare("SELECT * FROM party WHERE tokenParty = '$tokP'");
    $reqParty->execute();
    $dataParty = $reqParty->fetch(PDO::FETCH_ASSOC);

    // Check if both player are ready in DB
    if($dataParty['readyPlayer1'] === "1" && $dataParty['readyPlayer2'] === "1" ){
        echo "ready";
    } else {
        echo "no";
    }

?>
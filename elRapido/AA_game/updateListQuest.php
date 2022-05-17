<?php
    require_once "../ReUsedCode/config.php";
    
    $listIdQuest = $_GET['list'];
    $tokP = $_GET['tokP'];

    $insert = $bdd->prepare("UPDATE party SET listeQuestion = '$listIdQuest' WHERE tokenParty = '$tokP'");
    $insert->execute();
?>
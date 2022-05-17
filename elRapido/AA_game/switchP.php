<?php
    require_once "../ReUsedCode/config.php";

    $tokP = $_GET['tokP'];
    $switchP = $_GET['switchP'];

    if($switchP == 1){
        $insert = $bdd->prepare("UPDATE party SET switch = '2' WHERE tokenParty = '$tokP'");
    } elseif ($switchP == 2){
        $insert = $bdd->prepare("UPDATE party SET switch = '1' WHERE tokenParty = '$tokP'");
    } elseif ($switchP == 3){
        $insert = $bdd->prepare("UPDATE party SET switch = '3' WHERE tokenParty = '$tokP'");
    } elseif ($switchP == 4){
        $insert = $bdd->prepare("UPDATE party SET switch = '4' WHERE tokenParty = '$tokP'");
    }
    $insert->execute();
?>
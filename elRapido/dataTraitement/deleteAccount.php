<?php
    require_once '../ReUsedCode/config.php';

    if(isset($_GET['idq'])){

        $deleteAccount = $bdd->prepare("DELETE FROM player WHERE email = '".$_GET['idq']."'");
        $deleteAccount->execute();

        header('Location:deconnexion.php'); die();
    }
?>
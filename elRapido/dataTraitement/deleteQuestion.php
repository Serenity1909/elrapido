<?php
    require_once '../ReUsedCode/config.php';

    if(isset($_GET['idq'])){

        $deleteQuestion = $bdd->prepare("DELETE FROM question WHERE questionID = '".$_GET['idq']."'");
        $deleteQuestion->execute();

        header('Location:../questions.php?errQ=delete'); die();
    }
?>
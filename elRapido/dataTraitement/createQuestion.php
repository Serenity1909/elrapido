<?php

require_once '../ReUsedCode/config.php';

if(!empty($_POST['question']) && !empty($_POST['Ranswer']) && !empty($_POST['Wanswer1']) && !empty($_POST['Wanswer2']) && !empty($_POST['Wanswer3']))
    {
        // htmlspecialchars -> read special char in html
        $question = htmlspecialchars($_POST['question']);
        $Ranswer = htmlspecialchars($_POST['Ranswer']);
        $Wanswer1 = htmlspecialchars($_POST['Wanswer1']);
        $Wanswer2 = htmlspecialchars($_POST['Wanswer2']);
        $Wanswer3 = htmlspecialchars($_POST['Wanswer3']);

        $insert = $bdd->prepare("INSERT INTO question VALUES(null,'$question', '$Ranswer', '$Wanswer1', '$Wanswer2', '$Wanswer3')");
        $insert->execute();
        
        // relocate and return a success alert
        header('Location:../questions.php?errQ=succes'); die();
    }
    else {
        // relocate and return a fault alert
        header('Location:../questions.php?errQ=nean'); die();
    }

?>
<?php
    require_once '../ReUsedCode/config.php';

    $CurrQuest = $_GET['CurrQuest'];
    $ans1 = $_GET['ans1'];
    $ans2 = $_GET['ans2'];
    $ans3 = $_GET['ans3'];
    $ans4 = $_GET['ans4'];

    $update = $bdd->prepare("UPDATE party
                            SET CurrentQuestion = '$CurrQuest',
                                CurrentAnswer1 = '$ans1',
                                CurrentAnswer2 = '$ans2',
                                CurrentAnswer3 = '$ans3',
                                CurrentAnswer4 = '$ans4'");
    $update->execute();
?>
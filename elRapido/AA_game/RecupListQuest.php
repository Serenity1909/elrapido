<?php
    // I use mysqli because PDO :: FETCH_ASSOC send a wrong format
    require_once "../ReUsedCode/configSqli.php";
    
    $listID = $_GET['listID'];
    $listIDarray = explode(",",$listID);
    $allQuest=[];
    
    for ($i=0; $i < count($listIDarray) ; $i++) { 
        $id = $listIDarray[$i];

        $results = mysqli_query($conn, "SELECT * FROM question WHERE questionID = '$id'");
        $fetchedd = mysqli_fetch_all($results, MYSQLI_NUM);
        
        $allQuest = array_merge($allQuest, $fetchedd);
    }
    print(json_encode($allQuest));
?>
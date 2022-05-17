<?php
    // I use mysqli because PDO :: FETCH_ASSOC send a wrong format
    require_once "../ReUsedCode/configSqli.php";
    
    $tok = $_GET['tokP'];
    $actif = $_GET['actif'];
    $timer = $_GET['time'];

    if ($actif == '1'){
    $query = ("UPDATE party SET timerPlayer1 = '$timer' WHERE tokenParty = '$tok'");
    }
    if ($actif == '2'){
    $query = ("UPDATE party SET timerPlayer2 = '$timer' WHERE tokenParty = '$tok'");
    }

    $result = mysqli_query($conn, $query);

    print(json_enconde($result));
?>
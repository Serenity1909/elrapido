<?php
        // I use mysqli because PDO :: FETCH_ASSOC send a wrong format
        require_once "../ReUsedCode/configSqli.php";
    
        $tok = $_GET['tokP'];

        $result = mysqli_query($conn, "SELECT timerPlayer1, timerPlayer2 FROM party WHERE tokenParty = '$tok'");
        $fetched = mysqli_fetch_all($result, MYSQLI_NUM);

        $fin = json_encode($fetched);

        print($fin);
?>
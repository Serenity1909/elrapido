<?php
      // I use mysqli because PDO :: FETCH_ASSOC send a wrong format
      require_once "../ReUsedCode/configSqli.php";

      $tok = $_GET['tokp'];

      $results = mysqli_query($conn, "SELECT switch, pseudoPlayer1 FROM party WHERE tokenparty = '$tok'");
      $fetchedd = mysqli_fetch_all($results, MYSQLI_NUM);

      $fini = json_encode($fetchedd);

      print($fini);
?>
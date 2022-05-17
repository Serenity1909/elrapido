<?php
    require_once '../ReUsedCode/config.php';

    $req = $bdd->prepare("SELECT * FROM question ORDER BY RAND()");
    $req->execute();
    $fetched = $req->fetchAll();
    
    $fin = json_encode($fetched);

    print($fin);
?>
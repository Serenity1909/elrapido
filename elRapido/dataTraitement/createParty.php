<?php
    session_start();
    require_once "../ReUsedCode/config.php";
 
    $req = $bdd->prepare('SELECT * FROM player WHERE token = ?');
    $req->execute(array($_SESSION['user']));
    $data = $req->fetch();

    $success = 0;
    $msg = "";

    if(!empty($_POST['namedParty']))
    {
        // htmlspecialchars -> read special char in html
        $nameParty = htmlspecialchars($_POST['namedParty']);

        if(strlen($nameParty) < 20){
            $insert = $bdd->prepare('INSERT INTO party(tokenParty, tokenPlayer1, PseudoPlayer1, rankPlayer1, nameParty) 
                                                VALUES(:tokenParty, :tokenPlayer1, :PseudoPlayer1, :rankPlayer1, :nameParty)');
            $insert->execute(array(
                'tokenParty' => bin2hex(openssl_random_pseudo_bytes(64)),
                'tokenPlayer1' => $data['token'],
                'PseudoPlayer1' => $data['pseudo'],
                'rankPlayer1' => $data['ranked'],
                'nameParty' => $nameParty
            ));
            $success = 1;
            $msg = "party created";
        } else {
            $msg = "party name to long !";
        }
        
        
    } else {
        $msg = "party name empty";
    }

    $res = ["success" => $success, "msg" => $msg];
    echo json_encode($res);
?>
<?php
    session_start();
    require_once "../ReUsedCode/config.php";
    
    $switchP = $_GET['switchP'];
    $tokP = $_GET['tokP'];
    $tokenPlayer1 = $_GET['tokPlayer1'];
    $tokenPlayer2 = $_GET['tokPlayer2'];

    $tokenPlayer = $_SESSION['user'];

    // update "switch" in DB
    $insert = $bdd->prepare("UPDATE party SET switch = '$switchP' WHERE tokenParty = '$tokP'");
    $insert->execute();

    // get token of both player to update their own point
    $query = $bdd->prepare("SELECT tokenPlayer1, tokenPlayer2 FROM party WHERE tokenParty = '$tokP'");
    $query->execute();
    $dataParty = $query->fetch(PDO::FETCH_ASSOC);

    $tokenPlayer1 = $dataParty['tokenPlayer1'];
    $tokenPlayer2 = $dataParty['tokenPlayer2'];

    // get data player to update it after
    $recup = $bdd->prepare("SELECT totalParty, win, lose, ranked FROM player WHERE token = '$tokenPlayer'");
    $recup->execute();
    $dataPlayer = $recup->fetch(PDO::FETCH_ASSOC);
    
    $totalParty = $dataPlayer['totalParty'];
    $win = $dataPlayer['win'];
    $lose = $dataPlayer['lose'];
    $ranked = $dataPlayer['ranked'];


    // if switchP = 3 => Player 1 lose
    // if switchP = 4 => Player 2 lose
    if($switchP == 3){
        if($tokenPlayer1 == $tokenPlayer){
            $totalParty = $totalParty + 1;
            $lose = $lose + 1;

            $updatePlayer1 = $bdd->prepare("UPDATE player 
                                            SET totalParty = '$totalParty',
                                                lose = '$lose'
                                            WHERE token = '$tokenPlayer1'");
            $updatePlayer1->execute();

        } elseif($tokenPlayer2 == $tokenPlayer){
            $totalParty = $totalParty + 1;
            $win = $win + 1;
            $ranked = $ranked + 1;

            $updatePlayer2 = $bdd->prepare("UPDATE player 
                                            SET totalParty = '$totalParty',
                                                win = '$win',
                                                ranked = '$ranked'
                                            WHERE token = '$tokenPlayer2'");
            $updatePlayer2->execute();
        }

    } elseif ($switchP == 4){
        if($tokenPlayer1 == $tokenPlayer){
            $totalParty = $totalParty + 1;
            $win = $win + 1;
            $ranked = $ranked + 1;

            $updatePlayer1 = $bdd->prepare("UPDATE player 
                                            SET totalParty = '$totalParty',
                                                win = '$win',
                                                ranked = '$ranked'
                                            WHERE token = '$tokenPlayer1'");
            $updatePlayer1->execute();
        
        } elseif ($tokenPlayer2 == $tokenPlayer) {
            $totalParty = $totalParty + 1;
            $lose = $lose + 1;

            $updatePlayer2 = $bdd->prepare("UPDATE player 
                                            SET totalParty = '$totalParty',
                                                lose = '$lose'
                                            WHERE token = '$tokenPlayer2'");
            $updatePlayer2->execute();
        }
    }

    // security : delete party in DB after update both data player
    // (Just player 1 delete party)
    if(($switchP != 1 || $switchP != 2) && ($tokenPlayer1 == $tokenPlayer)){
        sleep(2);
        $deleteParty = $bdd->prepare("DELETE FROM party WHERE tokenParty = '$tokP'");
        $deleteParty->execute();
    }
?>
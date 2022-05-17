<?php
    session_start();
    require_once 'ReUsedCode/config.php'; 

    // if not in session => relocate homepage
    if(!isset($_SESSION['user'])){
        header('Location:index.php');
        die();
    }
    
    $title = 'PLAY NOW !';
    require 'ReUsedCode/header.php';
    
    require 'ReUsedCode/login.php';
?>

<section>

    <div id="playNow" class="btnPlay">
        <!-- main window with button "create party" and "join" -->
        <div class="btnP">
            <button class="btn btnP " id="btnCreate">Create Party</button>
            <button class="btn btnP " id="btnJoin">Join</button>
        </div>
    </div>

    <!-- second window to create a party (initially in display "none") -->
    <div id="createParty" class="btnPlay loginf">
        <form id="createGame">
            <label class="login">Name of Party</label>
            <input type="text" name="namedParty" id="namedParty" />
            <input type="submit" value="Create" />
        </form>
        <button class="btn" id="btnCancelCreate">Cancel</button>
    </div>

    <div id='waitingPopup'></div>

    <!-- third window to join a party (initially in display "none") -->
    <div id="joinParty" class="btnPlay">
        <h2 style="margin:15px auto;">Join a party</h2>
        <table>
            <thead>
                <tr style="color:white;">
                    <th>Number</th>
                    <th>Name of party</th>
                    <th>Pseudo Player</th>
                    <th>Rank</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $listeParty = 'SELECT tokenParty,nameParty, PseudoPlayer1, rankPlayer1 FROM party';
                    $result = $bdd->query($listeParty);

                    $number = 0;
                    while($row =$result->fetch(PDO::FETCH_NUM)){
                        echo "<tr>";

                        $number = $number + 1;
                        echo"<td>$number</td>";

                        foreach ($row as $value) {
                            if($value != $row[0]){
                                echo '<td>'.htmlspecialchars($value).'</td>';
                            }
                        }
                        // writes "join" corresponding to the party using the tokenParty ($ligne[0])
                        echo "<td> <a href='./dataTraitement/JoinGame.php?tokenP=$row[0]' class='btnJoin'>Join</a></td>";
                        echo "</tr>";
                    }
                ?>
            </tbody>
        </table>

        <br />

        <button class="btn" id="btnCancelJoin">Cancel</button>
    </div>

    <!-- Pop up waiting when a player create a party -->
    <div id='waitPopup'>
        <h5 style='margin-bottom:100px;font-size:3em;'>... Waiting for player ...</h5>
        <p class="classement">Please do not leave this page or press Cancel to go back.</p>
        <input  type ="submit" id='ajaxParty' class='btnP btn' value="Cancel" />
    </div>

</section>    

<!-- obligatory here because navigator detecte an error with addEvenListener (null) -->
<script>
    let win1 = document.getElementById("playNow");
    let win2 = document.getElementById("createParty");
    let win3 = document.getElementById("joinParty");

    // allows you to change window to create a game or join one
    // either in display "block" or in display "none"
    document.getElementById("btnCreate").addEventListener("click", () =>{
        win1.style.display = "none";
        win2.style.display = "block";
    });

    document.getElementById("btnCancelCreate").addEventListener("click", () =>{
        win1.style.display = "block";
        win2.style.display = "none";
    });

    document.getElementById("btnJoin").addEventListener("click", () =>{
        win1.style.display = "none";
        win3.style.display = "block";
    });

    document.getElementById("btnCancelJoin").addEventListener("click", () =>{
        win1.style.display = "block";
        win3.style.display = "none";
    });
</script>

<?php
require 'ReUsedCode/footer.php';
?>
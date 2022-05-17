<?php
session_start();
require_once 'ReUsedCode/config.php';
$title ='Help';
require 'ReUsedCode/header.php';

require 'ReUsedCode/login.php';
?>
<section class="help">
    <div class="presentation">
        <h3 class="subtitle"><em>Presentation :</em></h3>
        <br />
        <p>
            El rapîdo is a question game between two players. Each player
              must take turns answering the questions asked before the end of their timer
              (60 seconds). If the timer of one of the players reaches zero, the game ends
              and his opponent wins the game.
        </p>
    </div>
    
    <br />

    <div class="ranking">
        <h3 class="subtitle"><em>Ranking :</em></h3>
        <br />
        <p>
            On page "home", there is a scoreboard of the best players who are ranked in order
             decreasing in rank. <br />
            
             Here is how a player's rank is calculated : <br />
            <br />
                + 1 point per win <br /> <br />
                No negative point when you lose but you can see the number of games lost in the scoreboard!<br />
            <br /> <hr /> <br />
            On page "Personnal Space", each player can see their stats with : <br />
            <br />
                his rank. <br />
                the number of party played. <br />
                the number of win. <br />
                the number of lose. <br />
        </p>
    </div>

    <br />

    <div class="logSign">
        <h3 class="subtitle"><em> Sign in :</em></h3>
        <br />
        <p>
            To be able to register, the username and email must not be
             greater than 100 characters. Also, the password must match
             exactly to password retype.

             It is not possible to register twice with the same email and it is not possible to choose
             a nickname already created by another player.
        </p>
    </div>

    <br />

    <div class="logSign">
        <h3 class="subtitle"><em>Log in :</em></h3>
        <br />
        <p>
            To log in, you must enter your email address and password.
              corresponding. If you have forgotten your password or email address,
              please send me an email at mahieuarnaud1909@hotmail.com
        </p>
    </div>

    <br />

    <div class="InGame">
        <h3 class="subtitle"><em>In Game</em></h3>
        <br />
        <p>
            Before starting, the player who joins the game must refresh the page once. Then,
            each player must click once on "ready" to start the game.
            <br /> <br />
            The player who created the game always starts first. At the beginning of each turn, the
            player must click on "ready" to be able to answer the question.
            <br /> <br />
            As long as the first player has not found the correct answer to a question, another is
            asked and so on until he finds the correct answer.
            <br /> <br />
            When a player has found the correct answer to a question, it is the turn of the other
            player to click on "ready" and answer his question.
            <br /> <br />
            When a player's timer reaches 0, a window is displayed to know the winner and the 
            loser. You will automatically be redirected to the home page with your points update.
        </p>
    </div>
</section>

<?php
require 'ReUsedCode/footer.php';
?>
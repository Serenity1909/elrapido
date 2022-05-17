<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Party</title>
        <link rel="stylesheet" href="./css/mainStyle.css" />
        <link rel="stylesheet" href="./css/inGame.css" />
        <link rel="stylesheet" href="./css/indexStyle.css" />
    </head>

    <body>
        <!-- Button exit to give up -->
        <div class="exit">
            <input type="submit" id="giveUp" value="Exit" />
        </div>
        
        <!-- Bubble information for both player (pseudo / timer / button ready) -->
        <section class="bubblePlayer">
            <div>
                <div class="player1" id="player1">
                    <h5  id="pseudoPlayer1"></h5>
                    <img src="./img/chronobleu.jpg" alt="chrono" />
                    <p class="timer" id="timerPlayer1">60</p>
                    <input type="submit" id="ready1" value="Ready" />
                </div>
    
                <div class="player2" id="player2">
                    <h5 id="pseudoPlayer2"></h5>
                    <img src="./img/chronobleu.jpg" alt="chrono" />
                    <p class="timer"  id="timerPlayer2">60</p>
                    <input type="submit" id="ready2" value="Ready" />
                </div>
            </div>
        </section>

        <!-- Questions container -->
        <section class="infoQuizz" id="questContent">
            <p id="infoPlay" class="youTurn">click once on ready and wait please :D</p>
        <div class="questHeader">
                <h6 id="questionhead"></h6>
            </div>

            <div class="answer">
                <button type="submit" class="rep" id="rep1"></button>
                <button type="submit" class="rep" id="rep2"></button>
            </div>
            <div class="answer">
                <button type="submit" class="rep" id="rep3"></button>
                <button type="submit" class="rep" id="rep4"></button>
            </div>
        </section>

        <!-- Popup when there is a game over (timer = 0) -->
        <p id="popUpGameOver" class="popUpGameOver"></p>

        <script src="./AA_game/engineGame.js"></script>
    </body>

</html>
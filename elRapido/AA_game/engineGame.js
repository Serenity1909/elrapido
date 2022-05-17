// global variables to send update at both player with AJAX
var i = 0;

var tokenParty;
var namedParty;

// actif = 1 => Player 1
// actif = 2 => Player 2
var actif=0;

// switchP = 1 => turn for Player 1
// switchP = 2 => turn for Player 2
// switchP = 3 => Player 1 lose
// switchP = 4 => Player 2 lose
var switchP = 1;

// Allows you to press the button "ready" once only when it's your turn (boolean)
var issetTimeSet = false;

var tokenPlayer1;
var pseudoPlayer1;
var timerPlayer1 = 60;

var tokenPlayer2;
var pseudoPlayer2;
var timerPlayer2 = 60;

listIDQuestion =[];

var currentQuestion;
var currentAnswer1;
var currentAnswer2;
var currentAnswer3;
var currentAnswer4;

let rep1 = document.getElementById("rep1");
let rep2 = document.getElementById("rep2");
let rep3 = document.getElementById("rep3");
let rep4 = document.getElementById("rep4");

let btnReady1 = document.getElementById("ready1");
let btnReady2 = document.getElementById("ready2");

let BubblePlayer1 = document.getElementById('player1');
let BubblePlayer2 = document.getElementById('player2');

let popUpGameOver = document.getElementById('popUpGameOver');

// when a player answered good => change variable "switchP" and send it into db
function switchPlayer(){
    let xhswitch = new XMLHttpRequest();

    xhswitch.onreadystatechange = function() {
        if(this.readyState == 4 && this.status == 200){
            recupSwitchPlayer();
        }
    }
    xhswitch.open("GET","./AA_game/switchP.php?tokP=" + tokenParty + "&switchP=" + switchP, true);
    xhswitch.send();
}

//Get "switchP" in db when a player answered good
function recupSwitchPlayer(){
    let xhRecupSwitch = new XMLHttpRequest();

    xhRecupSwitch.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var recupSwitchs = JSON.parse(this.response);

            switchP = recupSwitchs[0][0];
        }
    }
    xhRecupSwitch.open("GET","./AA_game/recupSwitch.php?tokp=" + tokenParty,true);
    xhRecupSwitch.send();
}

// Initialize listQuestion & listIDQuestion
function getQuestionList(){
    let xhgetquest = new XMLHttpRequest();

    xhgetquest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200 ){
            listQuestion = JSON.parse(this.response);

            // Get the questionID of the remaining questions and writes them in listIDQuestion
            for(var i= 0; i < listQuestion.length; i++)
            {
                listIDQuestion.push(listQuestion[i][0]);
            }

            // when listIDQuestion is send in db, button "ready" appear for player 1
            if(listIDQuestion.length > 0){
                document.getElementById('ready1').style.display = "block";
            }

            //update db party with list ID of question
            xhsendList = new XMLHttpRequest();
            xhsendList.open("GET","./AA_game/updateListQuest.php?list=" + listIDQuestion + "&tokP=" + tokenParty, true);
            xhsendList.send();

        } else if(this.readyState == 4) {
            alert("problème création liste question.")
        }
    }

    xhgetquest.open("GET", "./AA_game/getQuestList.php", true);
    xhgetquest.send();
}

// Get listQuestion & listIDQuestion in DB
function recupIDList(){
    listIDQuestion =[];
    listIDQuest = [];

    // AJAX 1
    // ------

    let xhRecupId = new XMLHttpRequest();

    xhRecupId.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            listIDQuest = JSON.parse(this.response);

            // transform listIDQuest (json) in array to send with GET
            for(var i= 0; i < listIDQuest[0][0].split(',').length; i++)
            {
                const id = listIDQuest[0][0].split(',');
                listIDQuestion.push(id[i]);
            }

            // AJAX 2
            // ------

            // recup listQuestion create by player 1
            let xhRecupListQuest = new XMLHttpRequest();

            xhRecupListQuest.onreadystatechange = function(){
                if(xhRecupListQuest.readyState == 4 && xhRecupListQuest.status == 200){
                    listQuestion = JSON.parse(this.response);

                    // when listQuestion is initialized, stop Interval and button "ready" appear for player 2
                    if(listQuestion.length >0 && tokenPlayer2 == dataParty[1]){
                        document.getElementById('ready2').style.display = "block";
                    }

                } else if(this.readyState == 4) {
                    alert("problème récupération liste question.")
                }
            }

            xhRecupListQuest.open("GET","./AA_game/RecupListQuest.php?listID="+ listIDQuestion, true);
            xhRecupListQuest.send()

        }  else if(this.readyState == 4) {
            alert("problème récupération liste ID question.")
        }
    }

    xhRecupId.open("GET", "./AA_game/recupIdList.php?tokP=" + tokenParty, true);
    xhRecupId.send();
}

// update the id list with the remaining questions for other player
function updateIDList(){
    var updateListBeforeSwitch = [];
    for (let i = 0; i < listQuestion.length; i++) {
        updateListBeforeSwitch.push(listQuestion[i][0]);
    }

    let xhUpIdList = new XMLHttpRequest();

    xhUpIdList.open("GET","./AA_game/updateListQuest.php?tokP=" + tokenParty + "&list=" + updateListBeforeSwitch,true);
    xhUpIdList.send();
}

// get all data party before the begin of game
function recupDataPartyBegin(){
    let xhrecup = new XMLHttpRequest();

    xhrecup.onload = function(){
        dataParty = JSON.parse(this.response);

        tokenParty = dataParty[0]['tokenParty'];
        namedParty = dataParty[0]['nameParty'];

        tokenPlayer1 = dataParty[0]['tokenPlayer1'];
        pseudoPlayer1 = dataParty[0]['PseudoPlayer1'];
        timerPlayer1 = dataParty[0]['timerPlayer1'];

        tokenPlayer2 = dataParty[0]['tokenPlayer2'];
        pseudoPlayer2 = dataParty[0]['PseudoPlayer2'];
        timerPlayer2 = dataParty[0]['timerPlayer2'];

        // write player pseudo on both bubble perso
        document.getElementById('pseudoPlayer1').innerHTML = pseudoPlayer1;
        document.getElementById('pseudoPlayer2').innerHTML = pseudoPlayer2;

        if(tokenPlayer1 == dataParty[1]){
            getQuestionList();
        } else if(tokenPlayer2 == dataParty[1]){
            recupIDList();
        }
    }
    
    xhrecup.open("POST", "./AA_game/recupDataParty.php", true);
    xhrecup.send();
}

//write question and its answer on display with function "display()"
function Question(){
    currentQuestion = listQuestion[0][1];

    var listRep = [listQuestion[0][2],listQuestion[0][3],listQuestion[0][4],listQuestion[0][5]];
    
    // take a random answer in list "listRep"
    function randanswer(){
        var rand = Math.floor(Math.random()*listRep.length);
        var randValue = listRep[rand];
        var indexRand = listRep.indexOf(randValue);
        if(indexRand !== -1){
            listRep.splice(indexRand,1);
        }
        return randValue;
    }

    currentAnswer1 = randanswer();
    currentAnswer2 = randanswer();
    currentAnswer3 = randanswer();
    currentAnswer4 = randanswer();

    let xhCurrent = new XMLHttpRequest();

    xhCurrent.open("GET", "./AA_game/MajCurrent.php?CurrQuest=" + currentQuestion + "&ans1=" + currentAnswer1 + "&ans2=" + currentAnswer2 + "&ans3=" + currentAnswer3 + "&ans4=" + currentAnswer4, true);
    xhCurrent.send();

}

// Get current question and its answer for player who waiting
function recupCurrent(){
    let xhrecupCurr = new XMLHttpRequest();

    xhrecupCurr.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            var recupCurrentdata = JSON.parse(this.response);

            currentQuestion = recupCurrentdata[0][0];

            currentAnswer1 = recupCurrentdata[0][1];
            currentAnswer2 = recupCurrentdata[0][2];
            currentAnswer3 = recupCurrentdata[0][3];
            currentAnswer4 = recupCurrentdata[0][4];
        }
    }
    xhrecupCurr.open("GET", "./AA_game/recupCurrent.php?tokP=" + tokenParty, true);
    xhrecupCurr.send();
}

// ask another question when a player make mistake
function WrongAnswer(){
    listQuestion.shift();
    Question()
}

// check if both player are ready and if yes => game launch
function checkReadyBoth(){
    let xhcheckReady = new XMLHttpRequest();

    xhcheckReady.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.response == "ready"){
                clearInterval(checkBoth);

                btnReady1.style.opacity = "1";
                btnReady2.style.opacity = "1";

                interRecup = setInterval(() => {
                    recupSwitchPlayer();

                    if((switchP == 1 && actif == 1) || (switchP == 2 && actif == 2)){
                        document.getElementById('infoPlay').innerHTML = "Your turn !";
                    } else {
                        document.getElementById('infoPlay').innerHTML = "Wait please !";
                    }
                }, 1000);

                Display = setInterval(display, 1000);
                
                // Check every 7 second if a player give up
                setInterval(() => {
                    if(switchP == 3 || switchP == 4){
                        gameOver();
                        console.log("test");
                    }
                }, 7000);
            }
        }
    }
    xhcheckReady.open("GET", "./AA_game/checkBothReady.php?tokP=" + tokenParty, true);
    xhcheckReady.send();
}

// Get timer of other player to know her time
function recupTimer(){
    let xhrecupTimer = new XMLHttpRequest();
    
            xhrecupTimer.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    var dataTimer = JSON.parse(this.response);
        
                    timerPlayer1 = dataTimer[0][0];
                    timerPlayer2 = dataTimer[0][1];

                    if(timerPlayer1 < 0){
                        switchP = 3;

                        gameOver();
                        console.log("testrecup");


                    } else if(timerPlayer2 < 0){
                        switchP = 4;

                        gameOver();
                        console.log("testrecup");
                    }
                }
            }   
            xhrecupTimer.open("GET", "./AA_game/recupTimer.php?tokP=" + tokenParty, true);
            xhrecupTimer.send();
}

// send every second the time in db when it's our turn.
function setTime(){
    if (actif == 1 && switchP == 1){
        timerPlayer1 -=1;
        var time = timerPlayer1;

    } else if(actif == 2 && switchP == 2){
        timerPlayer2 -= 1;
        var time = timerPlayer2;
    }

    let xhTimer = new XMLHttpRequest();

    xhTimer.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            recupTimer();
        }
    }
    xhTimer.open("GET", "./AA_game/updateTimer.php?tokP=" + tokenParty + "&actif=" + actif + "&time=" + time, true);
    xhTimer.send();
}

// if a timer = 0 (in function recupTimer) => update in DB the data player if he win or if he lose
function gameOver(){
    let xhGameOver = new XMLHttpRequest();

    xhGameOver.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200){
            if(switchP == 3){
                if(actif == 1){
                    //player 1 lose
                    popUpGameOver.style.border = "5px solid red";
                    popUpGameOver.innerHTML = "!!! YOU LOSE !!! <br /> You'll be redirected to the homepage";

                } else if(actif == 2){
                    //player 2 win
                    popUpGameOver.style.border = "5px solid green";
                    popUpGameOver.innerHTML = "!!! YOU WIN !!! <br /> You'll be redirected to the homepage";

                }

            } else if(switchP == 4){
                if(actif == 1){
                    //player 1 win
                    popUpGameOver.style.border = "5px solid green";
                    popUpGameOver.innerHTML = "!!! YOU WIN !!! <br /> You'll be redirected to the homepage";

                } else if(actif == 2){
                    //player 2 lose
                    popUpGameOver.style.border = "5px solid red";
                    popUpGameOver.innerHTML = "!!! YOU LOSE !!! <br /> You'll be redirected to the homepage";
                }
            }

            popUpGameOver.style.display = "block";

            setTimeout(() => {
                window.location.replace("http://localhost/project/elRapido/index.php");
            }, 5000);
        }
    }

    xhGameOver.open("GET", "./AA_game/gameOver.php?tokP=" + tokenParty + "&switchP=" + switchP + "&tokPlayer1=" + tokenPlayer1 + "&tokPlayer2=" + tokenPlayer2, true);
    xhGameOver.send();
}

// show all information for both player
function display(){
    // Display timer for player 1 and player 2
    document.getElementById('timerPlayer1').innerHTML = timerPlayer1;
    document.getElementById('timerPlayer2').innerHTML = timerPlayer2;

    // Display current Question and Answers
    document.getElementById('questionhead').innerHTML = currentQuestion;

    document.getElementById('rep1').innerHTML = currentAnswer1;
    document.getElementById('rep2').innerHTML = currentAnswer2;
    document.getElementById('rep3').innerHTML = currentAnswer3;
    document.getElementById('rep4').innerHTML = currentAnswer4;

    // if it's turn player 1 on display player 1
    if(switchP == 1 && actif == 1){
        BubblePlayer2.style.opacity = "0.5";
        BubblePlayer1.style.border = "5px solid green";
        BubblePlayer1.style.opacity = "1";
    
    // if it's turn player 2 on display player 2
    } else if (switchP == 2 && actif == 2){
        BubblePlayer1.style.opacity = "0.5";
        BubblePlayer2.style.border = "5px solid green";
        BubblePlayer2.style.opacity = "1";
    
    // if it's turn player 2 on display player 1
    } else if(switchP == 2 && actif == 1){
        BubblePlayer1.style.opacity = "0.5";
        BubblePlayer2.style.border = "5px solid green";
        BubblePlayer2.style.opacity = "1";

    // if it's turn player 1 on display player 2
    } else if(switchP == 1 && actif == 2){
        BubblePlayer2.style.opacity = "0.5";
        BubblePlayer1.style.border = "5px solid green";
        BubblePlayer1.style.opacity = "1";
    }
}

// PopUp to confirm if you want give up before the end of game
function confirmationGiveUp(){
    return confirm("Do you really want to give up now ?");
}

// Button to answer at question
rep1.addEventListener('click', function(){
    if((switchP == 1 && actif == 1) || (switchP == 2 && actif == 2)){
        if(rep1.textContent == listQuestion[0][2]){
            listQuestion.shift();
            updateIDList();
            clearInterval(timer);
            issetTimeSet = false;
            switchPlayer();
        } else {
            WrongAnswer(0);
        }
    }
});
rep2.addEventListener('click', function(){
    if((switchP == 1 && actif == 1) || (switchP == 2 && actif == 2)){
        if(rep2.textContent == listQuestion[0][2]){
            listQuestion.shift();
            updateIDList();
            clearInterval(timer);
            issetTimeSet = false;
            switchPlayer();
        } else {
            WrongAnswer(0);
        }
    }
});
rep3.addEventListener('click', function(){
    if((switchP == 1 && actif == 1) || (switchP == 2 && actif == 2)){
        if(rep3.textContent == listQuestion[0][2]){
            listQuestion.shift();
            updateIDList();
            clearInterval(timer);
            issetTimeSet = false;
            switchPlayer();
        } else {
            WrongAnswer(0);
        }
    }
});
rep4.addEventListener('click', function(){
    if((switchP == 1 && actif == 1) || (switchP == 2 && actif == 2)){
        if(rep4.textContent == listQuestion[0][2]){
            listQuestion.shift();
            updateIDList();
            clearInterval(timer);
            issetTimeSet = false;
            switchPlayer();
        } else {
            WrongAnswer(0);
        }  
    }
});

// set ready in db when player 1 or player 2 click on button "ready"
// When game is lauching, we need to click again on ready when it s our turn to continue playing
btnReady1.addEventListener("click", function(e){
    if(actif === 0){
        e.preventDefault();
        let xhsetReady = new XMLHttpRequest();
    
        xhsetReady.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.response === "1"){
                    actif = 1;
                    checkBoth = setInterval(checkReadyBoth, 1000);
                    btnReady1.style.opacity = "0";
                }
            }
        }
        xhsetReady.open("GET", "./AA_game/setReady.php?tokenplayer=" + tokenPlayer1 + "&tokP=" + tokenParty, true);
        xhsetReady.send();
    } else{
        if(switchP == 1 && actif == 1 && issetTimeSet == false){
                Question();
                timer = setInterval(setTime, 1000);
                issetTimeSet = true;          
        }
    }
});
btnReady2.addEventListener("click", function(e){
    if(actif === 0){
        e.preventDefault();
        let xhsetReady = new XMLHttpRequest();

        xhsetReady.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
                if(this.response === "2"){
                    actif = 2;
                    checkBoth = setInterval(checkReadyBoth, 1000);
                    btnReady2.style.opacity = "0";
                }
            }
        }
        xhsetReady.open("GET", "./AA_game/setReady.php?tokenplayer=" + tokenPlayer2 + "&tokP=" + tokenParty, true);
        xhsetReady.send();
    } else{
        if(switchP == 2 && actif == 2 && issetTimeSet == false){
            Question();
            timer = setInterval(setTime, 1000);
            issetTimeSet = true;
        }
    }
});

// Button to give up
document.getElementById("giveUp").addEventListener('click', function(){
    
    var conf = confirmationGiveUp();
    
    if(conf == true){
        if(actif == 1){
            switchP = 3;
            switchPlayer();
    
        } else if(actif == 2){
            switchP = 4;
            switchPlayer();
        }
    }
})

// --------------------- //
// -------MAIN---------- //
// --------------------- //

// initialize all data of the party onload the page "inGame.php"
recupDataPartyBegin();

// if isn't turn of the player => display the screen of other player 
// and get the update data
setInterval(() => {
    if((switchP == 2 && actif == 1) || (switchP == 1 && actif == 2)){
        recupIDList(); 
        recupTimer();
        recupCurrent();
    }
}, 500);
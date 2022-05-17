function checkPlayer2(){

    console.log("check player 2");

    let xhtest = new XMLHttpRequest();

    xhtest.onreadystatechange = function(){
        if(this.readyState == 4 && this.status == 200){
            if(this.response == "Join"){
                window.location.assign("http://localhost/project/elRapido/inGame.php");   
            }
        }
    }

    xhtest.open("POST", "./dataTraitement/checkPlayer2.php", true);
    xhtest.send();
}

function confirmDeleteParty(){
    return confirm("Do you really want cancel your party ?");
}

// create party and check every second if player 2 join
document.getElementById('createGame').addEventListener("submit", function(e){
    e.preventDefault();

    var data = new FormData(this);

    let xhcreate = new XMLHttpRequest();

    xhcreate.onreadystatechange = function () {
        if(this.readyState == 4 && this.status == 200){
            var res = this.response;
            if(res.success == 1){
                document.getElementById('waitPopup').style.display = 'block';
                document.getElementById('createParty').style.display = 'none';

                setInterval(checkPlayer2, 1000);
            } else {
                alert(res.msg);
            }
        } else if(this.readyState == 4){
            alert("une erreur est survenue");
        }
    }
    xhcreate.open("POST", "./dataTraitement/createParty.php", true);
    xhcreate.responseType = "json";
    xhcreate.send(data);

    return false;
});

// delete party when click on Cancel on popup "waiting player 2"
document.getElementById('ajaxParty').addEventListener("click", function(e){
    e.preventDefault();

    // confirm if it isn't error
    if(confirmDeleteParty() == true){
        var xhdelete = new XMLHttpRequest();
    
        xhdelete.onreadystatechange = function(){
            if(this.readyState == 4){
                console.log('Party delete');
                console.log(this.response);
                if(this.response == "1"){
                    window.location.assign("http://localhost/project/elRapido/PlayNow.php");
                }
            }
        }
    
        xhdelete.open("POST", "./dataTraitement/deleteParty.php", true);
        xhdelete.send();
    }
})
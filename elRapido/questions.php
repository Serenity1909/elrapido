<?php
    session_start();
    require_once 'ReUsedCode/config.php';
    
    $title = 'Questions';
    require 'ReUsedCode/header.php';

    require 'ReUsedCode/login.php';


    $question = 'SELECT questionID, question, reponseVrai, reponseFaux1, reponseFaux2, reponseFaux3 FROM question ORDER BY questionID';
    $result = $bdd->query($question);
?>

<div class="divContener">
    <!-- table of all questions -->
    <table id="questionsTable">
        <thead>
            <tr>
                <th colspan="6">Questions</th>
            </tr>
        </thead>
        <tbody>
            <tr style="color:white;">
                <td>questionID</td>
                <td>question</td>
                <td>Right answer</td>
                <td>wrong answer1</td>
                <td>wrong answer2</td>
                <td>wrong answer3</td>
            </tr>
            <?php
                // While there are a next question in db
                while($row =$result->fetch(PDO::FETCH_NUM)){
                    echo "<tr>";
                    
                    // $row is an array (questionID, question, Rightanswer, Wronganswer1, Wronganswer2, Wronganswer3)
                    // write a value for each value in $row
                    foreach ($row as $value) {
                        echo '<td>'.htmlspecialchars($value).'</td>';
                    }
                    // writes "delete" corresponding to the question using the id ($row[0])
                    // add a javascript event to confirm the delete choice
                    echo"<td><a href='dataTraitement/deleteQuestion.php?idq=$row[0]' onclick = 'return confirmationQuest();'>Delete</a></td>";

                    // writes "update" corresponding to the question using the id ($row[0])
                    // relocate on other page (updatequestion.php) and take data of the question
                    // and write this data directly in update form
                    echo"<td><a href='updateQuestion.php?idq=$row[0]&amp;quest= $row[1]&amp; Ranswer=$row[2]&amp;
                    Wanswer1=$row[3]&amp; Wanswer2=$row[4]&amp; Wanswer3=$row[5]'>Update</a></td>";

                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<!-- button to add a question -->
<div class="btnQuest">
    <button class="btn" id="btnaddQuestion">Add</button>
</div>

<?php
    // Allows to give error messages for sign in
    if(isset($_GET['errQ']))
    {
        $err = htmlspecialchars($_GET['errQ']);

        switch($err)
        {
            case 'succes':
                ?>
                <div class="messageAlertQuestion messageRightQuestion"><strong>Success : </strong>Question create</div>
                <?php
                break;

            case 'delete':
                ?>
                <div class="messageAlertQuestion messageRightQuestion"><strong>Success : </strong>Question delete</div>
                <?php
                break;

            case 'nean':
                ?>
                <div class="messageAlertQuestion messageFauteQuestion"><strong>Error : </strong>One or more fields are empty</div>
                <?php
                break;
        }
    }
 ?>

<!-- create question form -->
<div class="btnPlay" id="createQuestion">
    <form class="loginf" method="POST" action="dataTraitement/createQuestion.php">

        <label class="login">Question :</label>
        <input type="text" name="question" />

        <label  class="login">Right answer :</label>
        <input type="text" name="Ranswer" />

        <label  class="login">wrong answer 1 :</label>
        <input type="text" name="Wanswer1" />

        <label  class="login">wrong answer 2 :</label>
        <input type="text" name="Wanswer2" />

        <label  class="login">wrong answer 3 :</label>
        <input type="text" name="Wanswer3" />

        <button class="btn" name="valider" type="submit">Create</button>

        <p style="float:right;"><a href="questions.php">Cancel</a></p>
    </form>

    <!-- obligatory here because navigator detecte an error with addEvenListener (null) -->
    <script>
        let btnaddquest = document.getElementById("btnaddQuestion");
        let addquest = document.getElementById("createQuestion");

        let btnUpQuestion = document.getElementById("btnUpQuestion");

        // allows you to display or remove the window for adding a question
        // when click on "add" button
        btnaddquest.addEventListener("click", () =>{
            if(addquest.style.display == "none"){
                addquest.style.display = "block";
            }
            else {
                addquest.style.display = "none";
            }
        })
    </script>
</div>

<?php
    $result->closeCursor();

    require 'ReUsedCode/footer.php';
?>
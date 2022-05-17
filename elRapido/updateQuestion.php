<?php
session_start();
require_once 'ReUsedCode/config.php';

$title = 'Update Question';
require 'ReUsedCode/header.php';

?>

<!-- update question form -->
<div class="btnPlay" id="updateQuestion">
    <form class="loginf" method="POST" action="dataTraitement/updateQuestion.php">

        <label class="login">ID Question :</label>
        <input type="text" name="Idq" value="<?php echo  $_GET['idq']; ?>" />

        <label class="login">Question :</label>
        <input type="text" name="question" value="<?php echo  $_GET['quest']; ?>" />

        <label  class="login">Right answer :</label>
        <input type="text" name="Ranswer" value="<?php echo  $_GET['Ranswer']; ?>" />

        <label  class="login">wrong answer 1 :</label>
        <input type="text" name="Wanswer1" value="<?php echo  $_GET['Wanswer1']; ?>" />

        <label  class="login">wrong answer 2 :</label>
        <input type="text" name="Wanswer2" value="<?php echo  $_GET['Wanswer2']; ?>" />

        <label  class="login">wrong answer 3 :</label>
        <input type="text" name="Wanswer3" value="<?php echo  $_GET['Wanswer3']; ?>" />

        <button class="btn" name="valider" type="submit">Update</button>

        <p style="float:right;"><a href="questions.php">Cancel</a></p>
    </form>
</div>


<?php
 require 'ReUsedCode/login.php';

require 'ReUsedCode/footer.php';
?>
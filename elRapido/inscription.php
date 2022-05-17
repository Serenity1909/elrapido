<?php
$title = 'Sign In';
require  'ReUsedCode/header.php';
?>

<!-- sign in form -->
<section id="containerInscription">
    <form method="POST" action="dataTraitement/inscriptionTraitement.php" id="signForm">
        <h2>Sign In</h2>
        
        <label class="login">Pseudo</label>
        <input type="text" name="pseudo" id="password" placeholder="Enter your pseudo" required='required' autocomplete="off" />
        
        <label class="login">E-mail</label>
        <input type="text" name="email" id="email" placeholder="Enter your adress mail" required='required' autocomplete="off" />
    
        <label class="login">Password</label>
        <input type="password" name="password" id="password" placeholder="Enter your password" required='required' autocomplete="off" />
        
        <label class="login">Retype password</label>
        <input type="password" name="password_retype" id="password_retype" placeholder="Retype your password" required='required' autocomplete="off" />
    
        <button class="btn" type="submit" onclick='testSignIn()'>Sign in</button>

        <p style="float:right;"><a href="index.php">Cancel</a></p>

        <?php
        // Allows to give error messages for sign in
        if(isset($_GET['reg_err']))
        {
            $err = htmlspecialchars($_GET['reg_err']);

            switch($err)
            {
                case 'success':
                    ?>
                    <div class="messageBonInscription"><strong>Success : </strong>successful registration !</div>
                    <?php
                    break;

                case 'password':
                    ?>
                    <div class="messageFauteInscription"><strong>Error : </strong>different password</div>
                    <?php
                    break;
                
                case 'email':
                    ?>
                    <div class="messageFauteInscription"><strong>Error : </strong> email not valid</div>
                    <?php
                    break;

                case 'email_length':
                    ?>
                    <div class="messageFauteInscription"><strong>Error : </strong> email to long</div>
                    <?php
                    break;

                case 'pseudo_length':
                    ?>
                    <div class="messageFauteInscription"><strong>Error : </strong> pseudo to long</div>
                    <?php
                    break;

                case 'already':
                    ?>
                    <div class="messageFauteInscription"><strong>Error : </strong> email or pseudo already exist</div>
                    <?php
                    break;
            }
        }
    ?>
    </form>
</section>

<?php
require 'ReUsedCode/footer.php';
?>
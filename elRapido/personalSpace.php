<?php
    session_start();
    require_once 'ReUsedCode/config.php';
    
    $title = 'Personal Space';
    require 'ReUsedCode/header.php';
    require 'ReUsedCode/login.php';
?>

<section class="Persospace">

    <!-- the progress of player -->
    <!-- $data is initialize in "login.php" -->
    <div class="PersoSpaceL">
        <p>Your pseudo : <?php echo $data['pseudo']; ?> </p>
        <br />
        <p>Your email : <?php echo $data['email']; ?> </p>
        <br /> <hr /> <br />
        <h4>Your score now !</h4>
        <br />
        <p>Rank : <?php echo $data['ranked']; ?></p>
        <br />
        <p>Total Party : <?php echo $data['totalParty']; ?></p>
        <br />
        <p>win : <?php echo $data['win']; ?></p>
        <p>lose : <?php echo $data['lose']; ?></p>

        <br />
        <?php
        // Delete account by email of player
        $email = $data['email'];
        echo"<a href='dataTraitement/deleteAccount.php?idq=$email' onclick = 'return confirmationAccount();'>Delete account !</a>";
        ?>
    </div>

    <?php
        // Allows to give error messages for change password
        if(isset($_GET['err'])){
            $err = htmlspecialchars($_GET['err']);
            switch($err){
                case 'current_password':
                    echo "<h3 class='messageFaute'>The current password is incorrect !</h3>";
                break;

                case 'success_password':
                    echo "<h3 class='messageBon'>The password has been changed successfully !</h3>";
                break; 
            }
        }
    ?>
    
    <div class="PersoSpaceR containermdp">

        <h3>Change password</h3>
        <br />

        <!-- change password form -->
        <form method="POST" action="dataTraitement/password_change.php">
            <label classe="login">Current Password</label>
            <input type="password" name='current_password' />

            <label class="login">New Password</label>
            <input type="text" name="new_password" />

            <label class="login">New Password Retype</label>
            <input type="text" name="new_password_retype" />

            <button class="btn" type="submit">Change password</button>

           <p style="float:right;"><a href="personalSpace.php">Cancel</a></p>
        </form>
    </div>
</section>

<?php
    require 'ReUsedCode/footer.php';
?>
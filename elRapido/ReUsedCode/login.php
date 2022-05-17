<?php
    // if a session is not launched then redirect to the connection bubble
    if(!isset($_SESSION['user'])){
        ?>
        <!-- Login -->
        <section class="container">
            <form class="loginf" method="POST" action="dataTraitement/connexionTraitement.php">
                <h2>Connection</h2>
                
                <label class="login">E-mail</label>
                <input type="text" name="email" placeholder="Enter your adresse mail" required='required' autocomplete="off" />
                

                <label class="login">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required='required' autocomplete="off" />
                

                <button class="btn" type="submit">Connection</button>

                <p style="float:right;"><a href="inscription.php">SIGN IN</a></p>

                    <!-- Error message for login -->
                <?php
                    if(isset($_GET['login_err']))
                    {
                        $err = htmlspecialchars($_GET['login_err']);

                        switch($err)
                        {
                            case 'password':
                                ?>
                                <div class="messageAlert"><strong>Erreur : </strong> mot de passe incorrect</div>
                                <?php
                                break;
                            
                            case 'email':
                                ?>
                                <div class="messageAlert"><strong>Erreur : </strong> email incorrect</div>
                                <?php
                                break;

                            case 'already':
                                ?>
                                <div class="messageAlert"><strong>Erreur : </strong> compte non existant</div>
                                <?php
                                break;
                        }
                    }
                ?>
            </form>
        </section>
        <?php
    }
    // if a session is launched then redirect to the personnal bubble
    else {
        $req = $bdd->prepare('SELECT * FROM player WHERE token = ?');
        $req->execute(array($_SESSION['user']));
        $data = $req->fetch();

        ?>
        <div class="PersoSpace">
            <h3 class="messageAccueil">Hi <?php echo $data['pseudo']; ?> !</h3>

            <nav class="PersoNav">
                <ul>
                    <li><a href="PlayNow.php">PLAY</a></li>
                    <br />
                    <li><a href="personalSpace.php">Personal Space</a></li>
                    <!-- check if player is an admin (0 = no and 1 = yes) -->
                    <?php if($data["admin"]==1){?>
                        <li><a href="questions.php">Questions</a></li>
                    <?php } ?>
                    <li><a href="./dataTraitement/deconnexion.php">Log off</a></li>
                </ul>
            </nav>
        </div>
        <?php
    }
?>
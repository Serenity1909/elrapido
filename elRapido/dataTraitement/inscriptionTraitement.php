<?php
    require_once '../ReUsedCode/config.php';

    if(!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password_retype']))
    {
        // htmlspecialchars -> read special char in html
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $password_retype = htmlspecialchars($_POST['password_retype']);

        // check if email exist in db
        // if there is already an email add 1 to $row
        $check = $bdd ->prepare("SELECT pseudo,email,password FROM player WHERE email =? OR pseudo = '$pseudo'");
        $check->execute(array($email));
        $data = $check->fetch();
        $row = $check->rowCount();

        $email = strtolower($email); 

        // if $check have found email in db => $row > 0 => impossible to sign in
        if($row== 0)
        {   
            // Check if pseudo or email is < 100 chars
            if(strlen($pseudo) <= 100)
            {
                if(strlen($email) <= 100)
                {
                    if(filter_var($email,  FILTER_VALIDATE_EMAIL))
                    {   
                        // Check if it's right password without mistake
                        if($password == $password_retype)
                        {   
                            // hash password in db for security
                            $cost = ['cost' => 12];
                            $password = password_hash($password, PASSWORD_BCRYPT, $cost);

                            // add the new member in db
                            $insert = $bdd->prepare('INSERT INTO player(Pseudo, Email, Password, token) VALUES(:pseudo, :email, :password, :token)');
                            $insert->execute(array(
                                'pseudo' => $pseudo,
                                'email' => $email,
                                'password' => $password,
                                'token' => bin2hex(openssl_random_pseudo_bytes(64))
                            ));
                            // relocate and return a success alert (reg_err)
                            header('Location:../inscription.php?reg_err=success');
                            die();
                        // relocate and return a fault alert (reg_err)
                        }else{ header('Location: ../inscription.php?reg_err=password'); die();}
                    }else{ header('Location: ../inscription.php?reg_err=email'); die();}
                }else{ header('Location: ../inscription.php?reg_err=email_length'); die();}
            }else{ header('Location: ../inscription.php?reg_err=pseudo_length'); die();}
        }else{ header('Location: ../inscription.php?reg_err=already'); die();}
    }
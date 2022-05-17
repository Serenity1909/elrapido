<?php   
    session_start();
    require_once '../ReUsedCode/config.php';

    if(!empty($_POST['current_password']) && !empty($_POST['new_password']) && !empty($_POST['new_password_retype']))
    {
        // htmlspecialchars -> read special char in html
        $current_password = htmlspecialchars($_POST['current_password']);
        $new_password = htmlspecialchars($_POST['new_password']);
        $new_password_retype = htmlspecialchars($_POST['new_password_retype']);

        // collect user data
        $check_password  = $bdd->prepare('SELECT password FROM player WHERE token = :token');
        $check_password->execute(array(
            "token" => $_SESSION['user']
        ));
        $data_password = $check_password->fetch();

        // if is right password
        if(password_verify($current_password, $data_password['password']))
        {
            if($new_password === $new_password_retype){

                // hash new password for security in db
                $cost = ['cost' => 12];
                $new_password = password_hash($new_password, PASSWORD_BCRYPT, $cost);

                $update = $bdd->prepare('UPDATE player SET password = :password WHERE token = :token');
                $update->execute(array(
                    "password" => $new_password,
                    "token" => $_SESSION['user']
                ));
                // relocate and return a success alert (err)
                header('Location:../personalSpace.php?err=success_password');
                die();
            }
        }
        else{
            // relocate and return a fault alert (err)
            header('Location:../personalSpace.php?err=current_password');
            die();
        }

    }
    else{
        // if form is send without data => relocate
        header('Location:../personalSpace.php');
        die();
    }

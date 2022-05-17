<?php
    // choose the right db in phpmyadmin 
    try 
    {
        $bdd = new PDO("mysql:host=localhost;dbname=elrapido;charset=utf8", "root", "");
    }
    catch(PDOException $e)
    {
        die('Erreur : '.$e->getMessage());
    }
?>
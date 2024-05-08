<?php
try {
    $username = "root";
    $password = "root";
    $bdd = new PDO('mysql:host=localhost;dbname=openedmsg;charset=utf8',$username, $password);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd2 = new PDO('mysql:host=localhost;dbname=msg;charset=utf8',$username, $password);
    $bdd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
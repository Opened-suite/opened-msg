<?php
try {
    $bdd = new PDO('mysql:host=localhost;dbname=palomsg;charset=utf8','root', 'root');
}
catch (Exception $e)
{
    die('TestErreur : ' . $e->getMessage());
}
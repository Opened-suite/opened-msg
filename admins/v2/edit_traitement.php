<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
} else {
    
}
require_once("../../config/config_db.php");

$getid = $_GET["id"];
$pseudo = $_POST["pseudo"];
$mdp = $_POST["mdp"];
$email = $_POST["email"];
$ip = $_POST["ip"];
$grade = $_POST["grade"];

try {
    $req_up = "UPDATE users SET id = :id, pseudo = :pseudo, email = :email, password = :password, ip = :ip, grade = :grade WHERE id = " . $getid;
    $stmt_up = $bdd->prepare($req_up);
    
    $stmt_up->execute(array(
        ":id" => $id,
        ":pseudo" => $pseudo,
        ":email" => $email,
        ":password" => $mdp,
        ":ip" => $ip,
        ":grade" => $grade
    ));
}
catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
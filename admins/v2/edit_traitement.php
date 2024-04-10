<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
} else {
    
}
require_once("../../config/config_db.php");

$getid = htmlspecialchars($_GET["id"]);
$pseudo = htmlspecialchars($_POST["pseudo"]);
if (empty($pseudo)) {
    $cur_pseudo = htmlspecialchars($_POST["cur_pseudo"]);
    
}
else {
    $cur_pseudo = $pseudo;
}
$mdp = htmlspecialchars($_POST["mdp"]);
if (empty($mdp)) {
    $cur_mdp = htmlspecialchars($_POST["cur_mdp"]);
}
else {
    $cur_mdp = password_hash($mdp, PASSWORD_DEFAULT);
}
$email = htmlspecialchars($_POST["email"]);
if (empty($email)) {
    $cur_email = htmlspecialchars($_POST["cur_email"]);
}
else {
    $cur_email = $email;
}
$ip = htmlspecialchars($_POST["ip"]);
if (empty($ip)) {
    $cur_ip = htmlspecialchars($_POST["cur_ip"]);
}
else {
    $cur_ip = $ip;
}
$grade = htmlspecialchars($_POST["grade"]);
if (empty($grade)) {
    $cur_grade = htmlspecialchars($_POST["cur_grade"]);
}
else {
    $cur_grade = $grade;
}

try {
        
    
        $req_up = "UPDATE users SET pseudo = :pseudo, email = :email, password = :password, ip = :ip, grade = :grade WHERE id = :id";
        $stmt_up = $bdd->prepare($req_up);
        
        $stmt_up->execute(Array(
            ":pseudo" => $cur_pseudo,
            ":email" => $cur_email,
            ":password" => $cur_mdp,
            ":ip" => $cur_ip,
            ":grade" => $cur_grade, 
            ":id" => $getid
        ));
        echo "L'utilisateur a bien été modifié";
    }
    

catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
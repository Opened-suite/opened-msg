<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
} else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
require_once "../../config/config_db.php";

try {
    $id = $_GET["id"];
    $req_del = "DELETE FROM users WHERE id = " . $id;
    $stmt = $bdd->prepare($req_del);
    $stmt->execute();
}
catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

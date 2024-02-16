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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../style/shared.css">
    <link rel="stylesheet" href="../../style/user.css">
    <title>Mon Compte </title>
</head>
<body>
    <h1>Bienvenue <?=$pseudo?>sur votre compte</h1>
        <div class="actions">
            <a href="../../deco/index.php"><button>Se Déconnecter</button></a>
            <a><button>Réinisialisation du mot de passe</button></a>
            <a href="../../home/contacts"><button>Aller aux messages</button></a>
    </div>
    <p>grade: 
        <?php
            try {
                $req = $bdd->prepare("SELECT * FROM `users` WHERE pseudo = :pseudo");
                $req->bindParam(':pseudo', $pseudo);

                $req->execute();
                $users = $req->fetch(PDO::FETCH_ASSOC);
                
                    echo $users["grade"];
                
            } catch (PDOException $e) {
                die("Erreur : " . $e->getMessage());
            }
        ?>
    </p>
</body>
</html>
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
require_once("../../../config/config_db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une personne a vos contacts</title>
    <link rel="stylesheet" href="/style/add.css">
</head>

<body>
    <?php require_once "../../../header.php" ?>
    <div class="container">
        <form action="add_user.php" method="post">
            <label for="pseudo_add">Entrez le nom d'utilisateur</label>
            <input type="text" name="pseudo_add">
            <input type="hidden" name="pseudo" value=<?=$pseudo?>>
            <input type="submit" value="envoyer">
        </form>
    </div>
</body>

</html>
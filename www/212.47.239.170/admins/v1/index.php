<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
}
else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
require_once(__DIR__ . "/.." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "header.php");
try {
    $bdd = new PDO('mysql:host=localhost;dbname=palomsg;charset=utf8', 'root', 'root');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active le mode d'affichage des erreurs
} catch (PDOException $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données
try {
    $req = $bdd->prepare("SELECT * FROM users");
    $req->execute();
    $dataList = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <title>Utilisateurs</title>
</head>

<body>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Email</th>
                <th scope="col">Token</th>
                <th scope="col">IP</th>
                <th scope="col">Outils</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($dataList as $data) {
                echo '<tr>';
                echo '<th scope="row">' . $data["id"] . '</th>';
                echo '<td>' . $data["pseudo"] . '</td>';
                echo '<td>' . $data["email"] . '</td>';
                echo '<td>' . $data["token"] . '</td>';
                echo '<td>' . $data["ip"] . '</td>';
                echo '<td scope="col">
                        <a href="">
                            <img width="30" height="30" src="https://img.icons8.com/color/30/edit--v1.png" alt="edit--v1"/>
                            </a>
                        <a href="">
                            <img width="30" height="30" src="https://img.icons8.com/color/30/trash--v1.png" alt="trash--v1"/>
                        </a>
                    </td>';
                echo '</tr>';
            }
            ?>
        </tbody>
    </table>
</body>

</html>
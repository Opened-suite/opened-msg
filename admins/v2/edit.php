<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
} else {
    $pseudo = "admin";
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
require_once("../../config/config_db.php");
$id = htmlspecialchars($_GET["id"]);
try {
    $req = $bdd->prepare("SELECT * FROM users WHERE id =".$id);
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
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/dashboard.css">
    <link rel="stylesheet" href="/style/edit.css">
    <title>Edit a user</title>
</head>
<body>
  <form action="edit_traitement.php?id=<?=$id?>" method="post">
    <table>
  <tr>
        <th scope="col">#</th>
        <th scope="col">Pseudo</th>
        <th scope="col">Mot De Passe</th>
        <th scope="col">Email</th>
        <th scope="col">IP</th>
        <th scope="col">Grade</th>
        <th scope="col">Envoyer</th>
        

    </tr>
    <?php
    foreach ($dataList as $data) {
        echo '<tr>';
        echo '<td><input type="text" value="' . $data["id"] . '" name="id"/> </td>';
        echo '<td><input type="text" value="' . $data["pseudo"] . '" name="pseudo"/> </td>';
        echo '<td><input type="text" value="" name="mdp"/> </td>';
        echo '<td><input type="text" value="' . $data["email"] . '" name="email"/> </td>';
        echo '<td><input type="text" value="' . $data["ip"] . '" name="ip"/> </td>';
        echo '<td><input type="text" value="' . $data["grade"] . '" name="grade"/> </td>';
        echo '<input type="hidden" name="cur_pseudo" value="' . $data["pseudo"] . '">';
        echo '<input type="hidden" name="cur_mdp" value="' . $data["password"] . '">';
        echo '<input type="hidden" name="cur_email" value="' . $data["email"] . '">';
        echo '<input type="hidden" name="cur_ip" value="' . $data["ip"] . '">';
        echo '<input type="hidden" name="cur_grade" value="' . $data["grade"] . '">';
        

        
        
    }
    
    ?>
    <td><input type="submit"> </td>
    </table>
  </form>  
</body>
</html>
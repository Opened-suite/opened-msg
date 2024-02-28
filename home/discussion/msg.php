
  
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/home.css">
        <link rel="stylesheet" href="/style/shared.css">
        <div id="messages">

<?php
session_start();
if (!isset($_SESSION["pseudo"]) && !isset($_SESSION["token"])) {
    header("location: /");
}
else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
$table = $_GET["table"];

try {
    require_once("../../config/config_db.php");

    // Check si il est admin
    $query_admin = 'SELECT `grade` FROM `users` WHERE `pseudo` = "' . $pseudo. '"';
    $stmt_admin = $bdd->prepare($query_admin);
    $stmt_admin->execute();
    $grade = $stmt_admin->fetchAll(PDO::FETCH_ASSOC);

    
    // Requête pour récupérer les messages de la table spécifiée
    $query_get_messages = 'SELECT * FROM '. $table;
    $stmt_messages = $bdd2->prepare($query_get_messages);
    $stmt_messages->execute();
    $messages = $stmt_messages->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        if ($message["by_send"] == $pseudo) {    
            echo '<div class="you msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
            
        }
        elseif($message["by_send"] == "admin") {
            echo '<span class="admin">'. $message["msg"].'</span>';
        }
        else {
            echo '<div class="other msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
        }

        $lastmsg = $message["id"];
            // Récupération des données
        
        
    }
    
    
    }   
catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
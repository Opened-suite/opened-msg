
    



<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: ".__DIR__);
}
else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
// if(!isset($_GET["table"])){
    //     header("location: /home/contacts/");
    // }
    ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/home.css">
        <link rel="stylesheet" href="/style/shared.css">
        <script src="test_api.js" defer></script>
        <title>Home</title>
    </head>
    <body >
    
        <div id="discussion">
<div id="messages">
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
$table = "cedrictojerem";

try {
    require_once("../config/config_db.php");
    
    // Requête pour récupérer les messages de la table spécifiée
    $query_get_messages = 'SELECT * FROM '. $table;
    $stmt_messages = $bdd2->prepare($query_get_messages);
    $stmt_messages->execute();
    $messages = $stmt_messages->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        if ($message["by_send"] == $pseudo) {    
            echo '<div class="you">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
            
        } else {
            echo '<div class="other">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
        }
    }
    // Récupération des données

    $maxIDresult = $bdd2->prepare('SELECT max(ID) as maxID FROM cedrictojerem');
    $maxIDresult->execute();
    $maxIDvalue = $maxIDresult->fetch();
    echo "<div class='hidden valuejs'>". $maxIDvalue['maxID'] . "</div>";
} catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
<form action="send_msg.php" method="post" id="sending">
    
    <input type="text" name="message" required>
    <input type="submit" value="" alt="send" accesskey="enter"/>
    <input type="hidden" name="table" value="<?=$table?>">
    <input type="hidden" name="bysend" value="<?=$pseudo?>">
</form>
            </div>
        </div>
        

</body>
</html>
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
if(!isset($_GET["table"])){
    header("location: /home/contacts/");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/home.css">
        <link rel="stylesheet" href="/style/shared.css">
        <script src="../../scripts/search.js" defer></script>
        <title>Home</title>
    </head>
    <body >
    
        <div id="contacts">
            
            <div class="contact">
                <div class="header">
                    <div class="title">Discussions Récentes</div>
                    <span class="logo">PaloMSG</span>
                    <span class="search"><input type="text" name="search" id="search" placeholder="  Search"><img width="30" height="30" src="https://img.icons8.com/color/30/search--v1.png" alt="search--v1"/></span>
                    
                </div>
                <div class="newContacts">
                    <?php
                    include_once ("../../config/config_db.php");
                        try {
                            
                            

                            // Requête pour récupérer les noms des tables
                            $query_already_contacted = "SHOW TABLES";
                            $stmt_alr_contacted = $bdd2->prepare($query_already_contacted);
                            $stmt_alr_contacted->execute();
                            $result = $stmt_alr_contacted->fetchAll(PDO::FETCH_ASSOC);
                            // Parcours des résultats
                            
                            foreach($result as $row) {
                                $tableName = $row['Tables_in_msg'];

                                
                                if (strpos($tableName, $pseudo) !== false) {
                                    echo '<a href="index.php?table='.$tableName.'"><div class="box-contact">
                                    <img width="30" height="30" src="https://img.icons8.com/color/30/user-male-circle--v1.png" alt="user-male-circle"/>
                                    <span class="nom">'.$tableName.'</span>
                                    </div></a>
                                    ';
                                    
                                }
                                else {
                                    
                                }
                                

                            }
                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage();
                        }
                        ?>
                </div>
                
            </div>
        </div>
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
$table = $_GET["table"];

try {
    require_once("../../config/config_db.php");

    // Check si il est admin
    $query_admin = 'SELECT `grade` FROM `users` WHERE `pseudo` = "' . $pseudo. '"';
    $stmt_admin = $bdd->prepare($query_admin);
    $stmt_admin->execute();
    $grade = $stmt_admin->fetchAll(PDO::FETCH_ASSOC);

    if ($grade == "admin") {
        $pseudon = "admin";
    }
    else {
        $pseudon = $pseudo;
    }
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
        $maxIDresult = $bdd2->prepare('SELECT max(ID) as maxID FROM '.$table);
        $maxIDresult->execute();
        $maxIDvalue = $maxIDresult->fetch();
        echo "<div class='hidden valuejs'>". $maxIDvalue['maxID'] . "</div>";
        echo "<div class='hidden valuetablejs'>".$table."</div>";
        
    }
    
    
    }   
catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
<form action="send_msg.php" method="post" id="sending">
    
    <input type="text" name="message" required autofocus class="msg-bar">
    <input type="submit" value="" alt="send" accesskey="enter"/>
    <input type="hidden" name="table" value="<?=$table?>">
    <input type="hidden" name="bysend" value="<?=$pseudon?>">
</form>
            </div>
        </div>
        
    </body>
    <script>
    
    </script>
            <script src="test_api.js" defer></script>

</html>
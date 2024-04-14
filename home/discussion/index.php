<?php
session_start();
include_once "../../config/config_db.php";

if (!isset($_SESSION["pseudo"]) && !isset($_SESSION["token"])) {
    header("location: /");
} else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
    if ($grade == "admin") {
        $pseudon = "admin";
    } else {
        $pseudon = $pseudo;
    }
}
if (!isset($_GET["table"])) {
    header("location: /home/contacts/");
} else {
    $table = htmlspecialchars($_GET["table"]); // Assurez-vous de sécuriser la valeur de $_GET["table"]
}
$maxIDresult = $bdd2->prepare('SELECT max(ID) as maxID FROM '.$table);
$maxIDresult->execute();
$maxIDvalue = $maxIDresult->fetch();
echo "<div class='hidden valuejs'>". $maxIDvalue['maxID'] . "</div>";
echo "<div class='hidden valuetablejs'>".$table."</div>";
        
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Security-Policy" content="default-src 'self'">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="/style/home.css">
        <link rel="stylesheet" href="/style/shared.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="../../scripts/search.js" defer></script>
        <title>Home</title>
    </head>
    <body >
    
        <div id="contacts">
            
            <div class="contact">
                <nav class="navbar navbar-dark bg-dark header">
                    <form class="container-fluid">
                        <div class="input-group">
                            <span class="input-group-text bg-dark text-light" id="basic-addon1">@</span>
                            <input type="text" class="form-control bg-dark text-light" id="search" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                    </form>
                </nav>
                <div class="newContacts">
                    <?php
                        try {  
                            $query_table_schema = "SELECT * FROM schema_table WHERE usr1 = '$pseudo' OR usr2 = '$pseudo'";
                            $stmt_table_schema = $bdd2->prepare($query_table_schema);
                            $stmt_table_schema->execute();
                            $result_table = $stmt_table_schema->fetchAll(PDO::FETCH_ASSOC);

                            foreach($result_table as $table_schema) {
                                $usr1 = $table_schema['usr1'];
                                $usr2 = $table_schema['usr2'];
                                $date = $table_schema['date'];
                                $tableName = $table_schema['tablename'];
                                if ($usr1 == $pseudo) {
                                    $usr = $usr2;
                                } else {
                                    $usr = $usr1;
                                }

                                echo '<a href="index.php?table='.$tableName.'"><div class="box-contact">
                                <img width="30" height="30" src="https://img.icons8.com/color/30/user-male-circle--v1.png" alt="user-male-circle"/>
                                <span class="nom">'.$usr.'</span>
                                </div></a>
                                ';
                                    
                                }
                                
                                

                            
                        } catch (PDOException $e) {
                            echo "Erreur : " . $e->getMessage();
                        }
                        
                        ?>
                </div>
                
            </div>
        </div>
        <div id="discussion">
<div class="iframemsg">
    <iframe src="/home/discussion/msg.php?table=<?=$table?>" frameborder="0" width="100%" height="90%" id="msgframe" ></iframe>
</div>
<span class="input-group mb-3">
    <form action="send_msg.php" method="post" id="sending">
        <input type="text" class="form-control bg-dark text-light" placeholder="Nom d'utilisateur du destinataire" aria-label="Nom d'utilisateur du destinataire" aria-describedby="button-addon2" name="message">
        <input class="btn btn-outline-light" type="submit" id="button-addon2" value="Envoyer">

        <input type="hidden" name="table" value="<?=$table?>">
        <input type="hidden" name="bysend" value="<?=$pseudon?>">
    </form>
</span>

        </div>
        
    </body>
    
    
            <script src="api/msg/msgapi.js" defer></script>

</html>
<?php
session_start();
include_once ("../../config/config_db.php");
session_start();
if (empty($_SESSION["pseudo"]) && empty($_SESSION["token"])) {
    header("location: /");
} else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/contacts.css">
    <script src="../../scripts/search.js" defer></script>
    <title>Liste Des Contacts</title>
</head>

<body>
    <nav>
        <span class="logo">Palo MSG</span>
        <span class="rechercher"><input type="text" name="search" id="search" placeholder="  Search"></span>
        <span class="add"><a href="add/">  Ajouter</a></span>
    </nav>
    <div class="contacts">
        <div class="title">--------- Récemment Contactés ---------</div>
        <div class="recentContacts">
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

        echo '<a href="../discussion/index.php?table='.$tableName.'"><div class="box-contact">
        <span class="logo"><img width="50" height="50" src="https://img.icons8.com/color/50/user-male-circle--v1.png" alt="user-male-circle--v1"/></span>
            <span class="nom">' . $usr . '</span>
        </div></a>
        ';
            
        }
        
        

    
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}

            ?>
        </div>
        <div class="title">--------- Contacts ---------</div>
            <div class="newContacts">
                <?php
                    $query_contacts = "SELECT contacts FROM contacts WHERE pseudo = '$pseudo'";
                    $stmt_contacts = $bdd->prepare($query_contacts);
                    $stmt_contacts->execute();
                    $result_contacts = $stmt_contacts->fetch(PDO::FETCH_ASSOC);
                    if ($result_contacts) {
                        $contacts = explode(";", $result_contacts['contacts']);
                        foreach ($contacts as $contact) {
                            $contact = trim($contact);
                            
                            if(!empty($contact) && $contact != $pseudo && $contact != $usr) {
                                $lien_create_discution = "/home/discussion/new/index.php?pseudo=" . $contact;
                                echo '<a href="' . $lien_create_discution . '" ><div class="box-contact">
                                <span class="logo"><img width="50" height="50" src="https://img.icons8.com/color/50/user-male-circle--v1.png" alt="user-male-circle--v1"/></span>
                                    <span class="nom">' . $contact . '</span>
                                    </div></a>';
                                }
                            
                            }
                        } else {
                        echo "Aucun résultat trouvé pour le pseudo '$pseudo'.";
                    }
                ?>
            </div>
    </div>
</body>

</html>
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
                require_once("../../config/config_db.php");

                // Requête pour récupérer les noms des tables
                $query_already_contacted = "SHOW TABLES";
                $stmt_alr_contacted = $bdd2->prepare($query_already_contacted);
                $stmt_alr_contacted->execute();
                
                // Parcours des résultats
                while ($row = $stmt_alr_contacted->fetch(PDO::FETCH_ASSOC)) {
                    $tableName = $row['Tables_in_msg'];
                    

                    // Vérification si le nom de la table contient "jerem"
                    if (strpos($tableName, $pseudo) !== false or strpos($pseudo, $tableName) !== false) {
                        echo '<a href="../index.php?table=' . $tableName . '"><div class="box-contact">
                            <span class="logo"><img width="50" height="50" src="https://img.icons8.com/color/50/user-male-circle--v1.png" alt="user-male-circle--v1"/></span>
                            <span class="nom">' . $tableName . '</span>
                            </div></a>';
                    }
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </div>
        <div class="title">--------- Contacts ---------</div>
            <div class="newContacts">
                <?php
                    $query_never_contacted = "SELECT contacts FROM contacts WHERE pseudo = '$pseudo'";
                    $stmt_nvr_contacted = $bdd->prepare($query_never_contacted);
                    $stmt_nvr_contacted->execute();
                    $result_nvr_contacted = $stmt_nvr_contacted->fetch(PDO::FETCH_ASSOC);
                    if ($result_nvr_contacted) {
                        $contacts = explode(";", $result_nvr_contacted['contacts']);
                        foreach ($contacts as $contact) {
                            $contact = trim($contact);
                            if(!empty($contact)) {
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
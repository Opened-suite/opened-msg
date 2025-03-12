<?php
session_start();
include_once("../../config/config_db.php");
if (empty($_SESSION["pseudo"]) && empty($_SESSION["token"])) {
    header("location: /");
} else {
    $pseudo = $_SESSION["pseudo"];

    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
?>
<div class="pseudo" style="display: none;"><?php echo $pseudo; ?></div>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/contacts.css">
    <script src="../../scripts/search.js" defer></script>
    <title>Liste Des Contacts</title>
    <style>
        .box-contact {
            display: flex;
            align-items: center;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 5px;
            border-radius: 5px;
            position: relative;
        }

        .box-contact .status {
            position: absolute;
            top: 10px;
            right: 10px;
            width: 10px;
            height: 10px;
            border-radius: 50%;
        }

        .status.online {
            background-color: green;
        }

        .status.offline {
            background-color: gray;
        }
    </style>
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

                foreach ($result_table as $table_schema) {
                    $usr1 = $table_schema['usr1'];
                    $usr2 = $table_schema['usr2'];
                    $date = $table_schema['date'];
                    $tableName = $table_schema['tablename'];
                    $usr = ($usr1 == $pseudo) ? $usr2 : $usr1;

                    echo '<a href="../discussion/index.php?table=' . $tableName . '">
                        <div class="box-contact" data-username="' . htmlspecialchars($usr) . '">
                            <span class="logo"><img width="50" height="50" src="https://img.icons8.com/color/50/user-male-circle--v1.png" alt="user-male-circle--v1"/></span>
                            <span class="nom">' . htmlspecialchars($usr) . '</span>
                            <span class="status offline"></span>
                        </div>
                    </a>';
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
                    if (!empty($contact) && $contact != $pseudo) {
                        $lien_create_discution = "/home/discussion/new/index.php?pseudo=" . $contact;
                        echo '<a href="' . $lien_create_discution . '">
                            <div class="box-contact" data-username="' . htmlspecialchars($contact) . '">
                                <span class="logo"><img width="50" height="50" src="https://img.icons8.com/color/50/user-male-circle--v1.png" alt="user-male-circle--v1"/></span>
                                <span class="nom">' . htmlspecialchars($contact) . '</span>
                                <span class="status offline"></span>
                            </div>
                        </a>';
                    }
                }
            } else {
                echo "Aucun résultat trouvé pour le pseudo '$pseudo'.";
            }
            ?>
        </div>
    </div>
    <script>
        const ws = new WebSocket('ws://localhost:8080');
        const contactElements = document.querySelectorAll('.box-contact');
        const pseudo = document.querySelector('.pseudo').textContent;

        ws.onopen = () => {
            contactElements.forEach(contact => {
                const username = contact.dataset.username;
                ws.send(JSON.stringify({ action: 'check_status', username }));
            });
        };

        ws.onmessage = (event) => {
            const data = JSON.parse(event.data);
            if (data.action === 'user_status') {
                const contactElement = document.querySelector(`.box-contact[data-username="${data.username}"]`);
                if (contactElement) {
                    const statusElement = contactElement.querySelector('.status');
                    if (data.status) {
                        statusElement.classList.remove('offline');
                        statusElement.classList.add('online');
                    } else {
                        statusElement.classList.remove('online');
                        statusElement.classList.add('offline');
                    }
                }
            }
        };
        console.log(contactElements);
        console.log(pseudo);
    </script>
</body>

</html>

// @ts-check
let recentContact = `<?php

// Informations de connexion à la base de données
$host = 'localhost';
$dbname = 'msg';
$dbname_main = 'palomsg';
$username = 'root';
$password = 'root';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo_main = new PDO("mysql:host=$host;dbname=$dbname_main", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête pour récupérer les noms des tables
    $query_already_contacted = "SHOW TABLES";
    $stmt_alr_contacted = $pdo->prepare($query_already_contacted);
    $stmt_alr_contacted->execute();

    // Parcours des résultats
    while ($row = $stmt_alr_contacted->fetch(PDO::FETCH_ASSOC)) {
        $tableName = $row['Tables_in_msg'];

        // Vérification si le nom de la table contient "jerem"
        if (strpos($tableName, $pseudo) !== false) {
            echo $tableName;
        }
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>`;

let contacts = `contacts = <?php
    

$query_never_contacted = "SELECT contacts FROM contacts WHERE pseudo = '$pseudo'";

$stmt_nvr_contacted = $pdo_main->prepare($query_never_contacted);

$stmt_nvr_contacted->execute();
$result_nvr_contacted = $stmt_nvr_contacted->fetch(PDO::FETCH_ASSOC);

if ($result_nvr_contacted) {
    $contacts = explode(";", $result_nvr_contacted['contacts']);
    echo "[";
    foreach ($contacts as $contact) {
        echo "\"".trim($contact)."\",";
    }
    echo "]";
} else {
    echo "Aucun résultat trouvé pour le pseudo '$pseudo'.";
}
?>`;

eval(contacts);

contacts.forEach(c => {
    let contactsHTML = document.querySelector("div#contacts");
    let contact = document.createElement("div");
    contact.classList.add("contact");
    let image = new Image(30, 30);
    image.src = "https://img.icons8.com/color/30/user-male-circle--v1.png";
    let name = document.createElement("span");
    name.innerHTML = c;
    contact.appendChild(image);
    contact.appendChild(name);
    contactsHTML.appendChild(contact);
})
console.log(contactsHTML);
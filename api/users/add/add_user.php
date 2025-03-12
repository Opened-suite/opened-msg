<?php
session_start();
header('Content-Type: application/json');

try {
    // Vérification et nettoyage des entrées avec trim pour enlever les espaces superflus
    $pseudo    = trim(htmlspecialchars($_POST["pseudo"]));
    $pseudoadd = trim(htmlspecialchars($_POST["pseudo_add"]));

    if (empty($pseudoadd)) {
        throw new Exception("Veuillez entrer un nom d'utilisateur à ajouter");
    }

    if (empty($pseudo)) {
        throw new Exception("Veuillez entrer votre nom d'utilisateur");
    }

    require_once("../../../config/config_db.php");

    // Vérification de l'existence des utilisateurs
    $query_verify = "SELECT pseudo FROM users WHERE pseudo IN (?, ?)";
    $stmt_verify = $bdd->prepare($query_verify);
    $stmt_verify->execute([$pseudo, $pseudoadd]);
    $existing_users = $stmt_verify->fetchAll(PDO::FETCH_COLUMN);

    if (count($existing_users) !== 2) {
        throw new Exception("Un ou les deux utilisateurs n'existent pas");
    }

    if ($pseudo === $pseudoadd) {
        throw new Exception("Vous ne pouvez pas vous ajouter vous-même");
    }

    $query = "SELECT contacts FROM contacts WHERE pseudo = ?";
    $stmt_contacts = $bdd->prepare($query);
    $stmt_contacts->execute([$pseudo]);
    $result_contacts = $stmt_contacts->fetch(PDO::FETCH_ASSOC);

    if ($result_contacts) {
        $contacts = !empty($result_contacts['contacts']) 
                    ? array_map('trim', explode(";", $result_contacts['contacts'])) 
                    : [];
        if (!in_array($pseudoadd, $contacts, true)) {
            $contacts[] = $pseudoadd;
            $new_contacts = implode(";", $contacts);
        } else {
            echo json_encode([
                "success" => true, 
                "message" => "Ce contact est déjà dans votre liste"
            ]);
            exit;
        }
    } else {
        $new_contacts = $pseudoadd;
    }

    $query_update = "INSERT INTO contacts (pseudo, contacts) VALUES (?, ?)
                     ON DUPLICATE KEY UPDATE contacts = ?";
    $stmt_update = $bdd->prepare($query_update);
    $stmt_update->execute([$pseudo, $new_contacts, $new_contacts]);

    echo json_encode([
        "success" => true, 
        "message" => "Contact ajouté avec succès"
    ]);

} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        "success" => false,
        "message" => $e->getMessage()
    ]);
}

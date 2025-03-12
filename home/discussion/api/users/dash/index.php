<?php

include_once "../../../../../config/config_db.php";

$user_send = htmlspecialchars($_GET["who"]);
$user_dash = htmlspecialchars($_GET["u"]);

// Vérification des paramètres
if (empty($user_send) || empty($user_dash)) {
    echo "Paramètres manquants.";
    exit;
}

try {
    // Préparer la requête SQL pour récupérer les contacts
    $sql_select = "SELECT contacts FROM contacts WHERE pseudo = :user_send";
    $stmt_select = $bdd->prepare($sql_select); // Correction : suppression de 'query:'
    $stmt_select->bindParam(":user_send", $user_send);
    $stmt_select->execute();
    $result_contacts = $stmt_select->fetch(PDO::FETCH_ASSOC); // Récupération des contacts

    // Si aucun contact trouvé
    if (!$result_contacts || !isset($result_contacts['contacts'])) {
        echo "Aucun contact trouvé.";
        exit;
    }

    // Liste des contacts
    $contacts = explode(";", $result_contacts['contacts']);

    // Vérification des contacts
    foreach ($contacts as $contact) {
        echo $contact;
        if ($contact == $user_dash) {
            // Sélectionner la valeur actuelle de dash
            $sql_dash_select = "SELECT dash FROM contacts WHERE pseudo = :user_send";
            $stmt_dash_select = $bdd->prepare($sql_dash_select);
            $stmt_dash_select->bindParam(":user_send", $user_send);
            $stmt_dash_select->execute();
            $result_dash = $stmt_dash_select->fetch(PDO::FETCH_ASSOC);

            if ($result_dash) {
                $dash_list = explode(";", $result_dash["dash"]); // Récupère la liste actuelle des dash
                if (!in_array($user_dash, $dash_list)) { // Vérifie si l'utilisateur n'est pas déjà dans dash
                    // Mise à jour de dash avec le nouveau user_dash
                    $new_dash = $result_dash["dash"] ? $result_dash["dash"] . ";" . $user_dash : $user_dash;
                    $sql_update = "UPDATE contacts SET dash = :dash WHERE pseudo = :user_send";
                    $stmt_update = $bdd->prepare($sql_update);
                    $stmt_update->bindParam(":dash", $new_dash);
                    $stmt_update->bindParam(":user_send", $user_send);
                    $stmt_update->execute();
                    echo "true";
                } else {
                    echo "L'utilisateur est déjà dans le dash.";
                }
            } else {
                echo "Erreur : dash non trouvé.";
            }
        } else {
            echo "false";
        }
    }

} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    exit;
}
?>

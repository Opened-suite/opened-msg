<?php
try {
    // Initialiser un tableau pour collecter les erreurs
    $response = ['success' => false, 'errors' => []];

    // Sanitize input
    $msg = isset($_POST['message']) ? htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8') : '';
    $table = isset($_POST['table']) ? htmlspecialchars($_POST['table'], ENT_QUOTES, 'UTF-8') : '';
    $by_send = isset($_POST['bysend']) ? htmlspecialchars($_POST['bysend'], ENT_QUOTES, 'UTF-8') : '';
    $new_name = ''; // Par défaut, pas d'attachement
    $real_name = '';
    $ext = '';

    // Validation des champs obligatoires
    if (empty($table)) {
        $response['errors'][] = "Le champ 'table' est requis.";
    }
    if (empty($msg) && empty($_FILES['image_file']['name']) && empty($_FILES['doc_file']['name'])) {
        $response['errors'][] = "Veuillez fournir un message ou un fichier à envoyer.";
    }

    // Si des erreurs existent, les retourner
    if (!empty($response['errors'])) {
        echo json_encode($response);
        exit;
    }

    // Handle file upload
    if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['image_file'];
        $allowed_types = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

        if (in_array($file['type'], $allowed_types)) {
            $id_file = uniqid();
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_name = $id_file . '.' . $ext;
            $real_name = pathinfo($file['name'], PATHINFO_FILENAME);
            $upload_dir = 'img/';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $upload_dir . $new_name)) {
                throw new Exception("Échec du téléchargement du fichier image.");
            }
        } else {
            $response['errors'][] = "Type de fichier image non pris en charge.";
        }
    } elseif (isset($_FILES['doc_file']) && $_FILES['doc_file']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['doc_file'];
        $allowed_types = ['application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'text/plain', 'application/vnd.oasis.opendocument.text'];

        if (in_array($file['type'], $allowed_types)) {
            $id_file = uniqid();
            $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
            $new_name = $id_file . '.' . $ext;
            $real_name = pathinfo($file['name'], PATHINFO_FILENAME);
            $upload_dir = 'docs/';

            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            if (!move_uploaded_file($file['tmp_name'], $upload_dir . $new_name)) {
                throw new Exception("Échec du téléchargement du fichier document.");
            }
        } else {
            $response['errors'][] = "Type de fichier document non pris en charge.";
        }
    }

    // Si tout est correct, insérer dans la base de données
    if (empty($response['errors'])) {
        $time_send = time();
        require_once "../../config/config_db.php";

        $query_add = 'INSERT INTO ' . $table . ' (msg, time_send, by_send, attachement) VALUES (:msg, :time_send, :by_send, :attachement)';
        $stmt_add = $bdd2->prepare($query_add);

        $stmt_add->bindParam(':msg', $msg);
        $stmt_add->bindParam(':time_send', $time_send);
        $stmt_add->bindParam(':by_send', $by_send);
        $stmt_add->bindParam(':attachement', $new_name);

        if ($stmt_add->execute()) {
            $response['success'] = true;
            $response['message'] = "Message envoyé avec succès.";
        } else {
            $response['errors'][] = "Échec de l'enregistrement du message dans la base de données.";
        }
    }

    // Retourner la réponse JSON
    echo json_encode($response);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'errors' => ["Erreur de base de données : " . $e->getMessage()]]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'errors' => ["Erreur : " . $e->getMessage()]]);
}

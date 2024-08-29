<?php

try {
    $msg = htmlspecialchars($_POST["message"]);
    $table = htmlspecialchars($_POST["table"]);
    $by_send = $_POST["bysend"];
    $new_name = '';

    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        $allowed_types = array('image/jpeg', 'image/gif', 'image/bmp', 'image/png', 'image/ico', 'image/svg+xml', 'image/webp');
        if (in_array($file['type'], $allowed_types)) {
            $new_name = uniqid(). '.'. pathinfo($file['name'], PATHINFO_EXTENSION);
            $upload_dir = 'img/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            move_uploaded_file($file['tmp_name'], $upload_dir. $new_name);
        } 
    }
    
    $time_send = time();
    
    require_once "../../config/config_db.php";

    if (!empty($table) && (!empty($new_name) || !empty($msg))) {
        $query_add = 'INSERT INTO ' . $table . ' (msg, time_send, by_send, attachement) VALUES (:msg, :time_send, :by_send, :attachement)';

        $stmt_add = $bdd2->prepare($query_add);
        $stmt_add->bindParam(':msg', $msg);
        $stmt_add->bindParam(':time_send', $time_send);
        $stmt_add->bindParam(':by_send', $by_send);
        $stmt_add->bindParam(':attachement', $new_name);
        
        $stmt_add->execute();
        
        // Exécution du fichier send_api.php
        $api_result = include __DIR__ . '/api/msg/send_api.php';
        
        // Vous pouvez logger le résultat de l'API si nécessaire
        error_log("Résultat de l'API: " . json_encode($api_result));
        
        header('location: index.php?table=' . $table);
        exit;
    } 
    else {
        header("location: index.php?table=" . $table);
        exit;
    }
} catch (PDOException $e) {
    echo $query_add;
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
</div>
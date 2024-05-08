<?php

try {
    $msg = htmlspecialchars($_POST["message"]);
    $table = htmlspecialchars($_POST["table"]);
    $by_send = $_POST["bysend"];
    if (isset($_FILES['file'])) {
        $file = $_FILES['file'];
        // Check if the file is an image
        $allowed_types = array('image/jpeg', 'image/gif', 'image/bmp');
        if (in_array($file['type'], $allowed_types)) {
            // Rename the file
            $new_name = uniqid(). '.'. pathinfo($file['name'], PATHINFO_EXTENSION);
            // Upload the file to the img/ directory
            $upload_dir = 'img/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            move_uploaded_file($file['tmp_name'], $upload_dir. $new_name);
            // Register the file name
            $registered_name = $new_name;
        } 
    }
    
    $time_send = time(); // Utilisez time() pour obtenir le timestamp actuel
    
    require_once "../../config/config_db.php";

    if (!empty($msg) && !empty($table)) {
        // Requête pour insérer un nouveau message dans la table spécifiée
        $query_add = 'INSERT INTO ' . $table . ' (msg, time_send, by_send, attachement) VALUES (:msg, :time_send, :by_send, :attachement)';

        $stmt_add = $bdd2->prepare($query_add);
        $stmt_add->bindParam(':msg', $msg);
        $stmt_add->bindParam(':time_send', $time_send);
        $stmt_add->bindParam(':by_send', $by_send);
        $stmt_add->bindParam(':attachement', $new_name);
        
        // Exécutez la requête préparée
        $stmt_add->execute();
        
        // Redirigez vers la page index.php avec le nom de la table en paramètre
        header('location: index.php?table=' . $table);
        exit; // Assurez-vous de terminer le script après la redirection
    } else {
        // Si le message est vide, redirigez vers la page d'accueil
        header("location: /");
        exit;
    }
} catch (PDOException $e) {
    echo $query_add;
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
</div>

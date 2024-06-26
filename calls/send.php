<?php

$url = htmlspecialchars($_GET["url"]);
$table = htmlspecialchars($_GET["table"]);
$usr = htmlspecialchars($_GET["usr"]);

try {
    $msg = "You have received a call by " . $usr . "<a href='" . $url . "'Click here to accept it</a>";
    $by_send = "admin";
    
    $time_send = time(); // Utilisez time() pour obtenir le timestamp actuel
    
    require_once "../config/config_db.php";

    if (!empty($msg) && !empty($table)) {
        // Requête pour insérer un nouveau message dans la table spécifiée
        $query_add = 'INSERT INTO ' . $table . ' (msg, time_send, by_send) VALUES (:msg, :time_send, :by_send)';

        $stmt_add = $bdd2->prepare($query_add);
        $stmt_add->bindParam(':msg', $msg);
        $stmt_add->bindParam(':time_send', $time_send);
        $stmt_add->bindParam(':by_send', $by_send);
        
        // Exécutez la requête préparée
        $stmt_add->execute();
        
        // Redirigez vers la page index.php avec le nom de la table en paramètre
        header('location: index.php?url=' . $url);
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


<?php


try {
    
    $msg = htmlspecialchars($_POST["message"]);
    $table = htmlspecialchars($_POST["table"]);
    $by_send = $_POST["bysend"];
    
    
    $time_send = date_timestamp_get(date_create('now'));

    require_once "../../config/config_db.php" ;

    if(!empty($msg)) {
        // Requête pour récupérer les messages de la table spécifiée
        $query_add = 'INSERT INTO '. $table . '(msg, time_send, by_send) VALUES (:msg, :time_send, :by_send)';

        $stmt_add = $bdd2->prepare($query_add);
        $stmt_add->bindParam(':msg', $msg);
        $stmt_add->bindParam(':time_send', $time_send);
        $stmt_add->bindParam(':by_send', $by_send);
        $stmt_add->execute();
        header('location: index.php?table='.$table);
    }
    else {
        header("location: /");
    }
    
    
    
} 
catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}
?>
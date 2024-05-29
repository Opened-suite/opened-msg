<?php 
require_once("../config/config_db.php");
function isTimestampOlderThanOneYear($timestamp) {
    // Obtenir la date actuelle
    $currentDate = new DateTime();
    
    // Créer une date à partir du timestamp donné
    $givenDate = new DateTime();
    $givenDate->setTimestamp($timestamp);
    
    // Calculer la différence entre les deux dates
    $interval = $currentDate->diff($givenDate);
    
    // Vérifier si la différence est d'un an ou plus
    if ($interval->y >= 1) {
        return true;
    } else {
        return false;
    }
}

// Récupération des données
try {
    $req = $bdd->prepare("SELECT * FROM stats WHERE type = 'users' AND date_checked = (SELECT MAX(date_checked) FROM stats)");
    
    $reqnb1 = $bdd->prepare("SELECT COUNT(*) FROM users");
    $reqnb1->execute();
    $req->execute();
    $nb1 = $reqnb1->fetchColumn();
    $dataList = $req->fetchAll(PDO::FETCH_ASSOC);

    foreach ($dataList as $data) {
    
        $oneYearAgoTimestamp = $data["date_checked"]; 
        if (isTimestampOlderThanOneYear($oneYearAgoTimestamp)) {
            $req1 = $bdd->prepare("DELETE FROM stats WHERE type = 'users'");
            $req1->execute();
            $req2 = $bdd->prepare("INSERT INTO stats (type, data, date_checked) VALUES ('users', :data, :date_checked)");
            $req2->execute(array(
                'data' => $nb1,
                'date_checked' => time()
            ));
        }
        
    }
    
    if ($req->rowCount() == 0) {
        
        $req2 = $bdd->prepare("INSERT INTO stats (type, data, date_checked) VALUES ('users', :data, :date_checked)");
        $req2->execute(array(
            'data' => $nb1,
            'date_checked' => time() // Utilisation d'un timestamp Unix
        ));

        
    }
    echo "<img src='' onload='testok()'>";
} 



catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<script>
    function testok() {
        history.back();
    }
</script>
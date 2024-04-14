
<?php
include_once("../../../../config/config_db.php");
$table = $_GET["table"];

// Récupération des données
try {
    $maxIDresult = $bdd2->prepare('SELECT max(ID) as maxID FROM '.$table);
    $maxIDresult->execute();
    $maxIDvalue = $maxIDresult->fetch();
    echo $maxIDvalue['maxID'];
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>


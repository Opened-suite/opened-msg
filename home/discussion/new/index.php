<?php
session_start();
if (!isset($_SESSION["pseudo"]) || !isset($_SESSION["token"])) {
    header("location: /");
}
else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
$pseudo_create = $_GET["pseudo"];

try {
    require_once "../../../config/config_db.php";

    // Vérification si la table cedricTOjerem existe
    $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'msg' AND (TABLE_NAME = '".$pseudo."TO".$pseudo_create."' OR TABLE_NAME = '".$pseudo_create."TO".$pseudo."')";
    $stmt = $bdd2->prepare($query);
    $stmt->execute();

    if ($stmt->rowCount() == 0) {
        // La table n'existe pas, on la crée
        $req_create = $bdd2->prepare("CREATE TABLE ".$pseudo_create."TO" . $pseudo." (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            msg LONGTEXT NOT NULL,
            time_send BIGINT(50),
            by_send VARCHAR(50)
        )");
        $req_shchema = $bdd2->prepare("INSERT INTO schema_table (tablename, usr1, usr2, date) VALUES ('".$pseudo_create."TO".$pseudo."', '$pseudo', '$pseudo_create', NOW())");
        $req_create->execute();
        $req_shchema->execute();
        echo "Table créée avec succès.";
        header("location: ../index.php?table=".$pseudo_create."TO".$pseudo);
    } else {
        echo "La table ". $pseudo . "TO" . $pseudo_create;
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

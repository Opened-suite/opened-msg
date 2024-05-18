<?php
session_start();
try {
$pseudo = $_POST["pseudo"];
$pseudoadd = htmlspecialchars($_POST["pseudo_add"]);

require_once("../../../config/config_db.php");


$query = "SELECT contacts FROM contacts WHERE pseudo = '$pseudo'";
$stmt_nvr_contacted = $bdd->prepare($query);
$stmt_nvr_contacted->execute();
$result_nvr_contacted = $stmt_nvr_contacted->fetch(PDO::FETCH_ASSOC);

if (!empty($result_nvr_contacted)) {
    $contacts = explode(";", $result_nvr_contacted['contacts']);
    if ($contacts != $pseudoadd) {
        $query2 = "UPDATE contacts SET contacts = :new_contacts WHERE pseudo = '$pseudo'";
        $stmt2 = $bdd->prepare($query2);
        $stmt2->execute(array(
            ":new_contacts" => $result_nvr_contacted['contacts'] . ";" . $pseudoadd
        ));
        header("location: ../");
    }
} 
elseif(empty($result_nvr_contacted)) {
    $contactsn = "";
    
        $query2 = "UPDATE contacts SET contacts = :new_contacts WHERE pseudo = '$pseudo'";
        $stmt2 = $bdd->prepare($query2);
        $stmt2->execute(array(
            ":new_contacts" => $pseudoadd
    ));
    
    header("location: ../../");
}
}
catch (PDOException $e) {
    echo "error". $e->getMessage() ."";
}

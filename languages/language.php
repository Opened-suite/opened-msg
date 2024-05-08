<?php
include '../config/config_db.php';

// Récupérer les données de langue depuis la base de données
$query = $bdd->query("SELECT language, country FROM lang WHERE is_this = 1");
$data = $query->fetch(PDO::FETCH_ASSOC);

if (!$data) {
    echo "Aucune donnée de langue trouvée dans la base de données où 'is_this' est true.";
}

// Construire le nom du fichier en fonction de la langue et du pays
$lang_file = '../languages/' . $data['language'] . '/' . $data['language'] . '_' .  $data['country']. '.php';

// Vérifier si le fichier correspondant existe
if (file_exists($lang_file)) {
    // Inclure le fichier de langue
    include($lang_file);
} else {
    echo "Le fichier de langue correspondant n'existe pas.";
}

// Vous pouvez maintenant utiliser les variables définies dans le fichier de langue importé
?>

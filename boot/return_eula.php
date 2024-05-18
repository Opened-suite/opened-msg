<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["accepted"] === "true") {
        $file = fopen("../sys/eula.txt", "w");
        fwrite($file, "true");
        fclose($file);
        echo "Vous avez accepté les termes du CLUF.";
        header("location: /");
        
    } else {
        echo "Erreur : Veuillez accepter les termes du CLUF.";
    }
}
?>

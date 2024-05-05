<?php
   $config = json_decode(file_get_contents("config/config.json"), true);


   // Get First Route
   $general = $config["general"];
   
   
   
   
   // General route
   $name = $general["name"];
   $logopath = $general["logopath"];
   
   
   
   
   
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/welcome.css">
        <script src="scripts/script.js" defer></script>
        <title>Bienvenue sur <?= $name; ?> </title>
    </head>
    <body>

    <?php
        include("header.php")
    ?>
    <div id="welcome">
            <div>
                <p>Bienvenue sur <?= $name; ?> Veuillez créer un compte pour commencer à chatter avec vos amis!</p>
    <a href="form/v1/inscription/" class="btnstart">Créer un compte</a>
                
            </div>

    </div>
    
    </body>
</html>
<?php
    $name = "OpenedMSG";
$eula = file_get_contents('./sys/eula.txt');   
   if ($eula != "true") {
        header("location: ./boot/eula.php");
   }
   
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
    <video src="/img/bg1.mp4" id="bg" autoplay loop muted playsinline>
    Votre navigateur ne supporte pas la balise vidéo.
</video>
    <?php
        include("./header.php")
    ?>
    <div class="content">
        <div id="mockup">
            <img src="img/mockup.png" alt="mockup">
        </div>
        <div id="welcome">
            
            <p>Bienvenue sur <?= $name; ?> Veuillez créer un compte pour commencer à chatter avec vos amis!</p>
            <a href="/form/v1/inscription/" class="btnstart">Créer un compte</a>
                    
                

        </div>
    </div>
    
    </body>
</html>
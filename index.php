<?php
    include_once('/config/config_json.php');
    echo "<script>alert(".$wname.");</script>";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style/welcome.css">
        <script src="scripts/script.js" defer></script>
        <title>Bienvenue sur  <?php echo $wname;?></title>
    </head>
    <body>
    <?php
        include("header.php")
    ?>
    <div id="welcome">
            <div>
                <p>Bienvenue sur <?php echo $wname;?> Veuillez créer un compte pour commencer à chatter avec vos amis!</p>
                <a href="form/v1/inscription/" class="button">Créer un compte</a>
            </div>
        </div>
    </body>
</html>
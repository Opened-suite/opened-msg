
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="/style/login.css">
    <link rel="stylesheet" href="/style/shared.css">
    <title>Formulaire Inscription</title>
</head>

<body>
    <?php require_once(__DIR__ . "/.." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "header.php") ?>
    <form action="connection.php" method="post" id="welcome">
        <div id="formbox">
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div>
                <label for="password">Mot de Passe: </label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
            </div>
            <div>
                <input type="submit" value="Envoyer">
            </div>
            <p class="link-register" style="font-size: 15px; color: #000;"><a href="inscription/" >Vous n'avez pas de compte ? Créez en un !</a></p>
        </div>
    </form>
    
</body>

</html>
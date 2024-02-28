<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Pragma" content="no-cache">
    <link rel="stylesheet" href="/style/login.css">
    <link rel="stylesheet" href="/style/shared.css">
    <script src="/scripts/password.js" defer></script>
    <title>Formulaire Inscription</title>
</head>

<body>
    <?php require_once(__DIR__ . "/.." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "header.php") ?>
    <form action="inscription.php" method="post" id="welcome">
        <div id="formbox">
            <div>
                <label for="pseudo">Pseudo</label>
                <input type="text" name="pseudo" id="pseudo" placeholder="Pseudo">
            </div>
            <div>
                <label for="email">Email: </label>
                <input type="email" name="email" id="email" placeholder="Email">
            </div>
            <div>
                <label for="password">Mot de Passe: </label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <p id="passwordStrength" style="color: red">Force du mot de passe: 0/3</p>
            </div>

            <div>
                <input type="submit" value="Envoyer" id="passwordSend" disabled style="cursor: not-allowed">
            </div>
            <p class="link-register" style="color: #000;"><a href="../">Vous avez déjà un compte ? Connectez Vous !</a></p>
        </div>
    </form>
</body>

</html>
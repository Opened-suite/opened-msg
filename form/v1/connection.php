<?php
session_start();
try {
    include_once "../../config/config_db.php";

    $email = htmlspecialchars($_POST["email"]);
    $password = htmlspecialchars($_POST["password"]);

    if (!empty($email) && !empty($password)) {
        $req = $bdd->prepare("SELECT * FROM users WHERE email = :email");
        $req->bindParam(":email", $email);
        $req->execute();
        $data = $req->fetch(PDO::FETCH_ASSOC);

        if ($data && password_verify($password, $data["password"])) {
            $_SESSION["pseudo"] = $data["pseudo"];
            $_SESSION["token"] = $data["token"];
            $_SESSION["email"] = $data["email"];
            $_SESSION["ip"] = $data["ip"];
            header("location: /home/");
            exit;
        } else {
            echo "Mot de passe incorrect ou email non trouvé.";
        }
    } else {
        echo "Veuillez remplir tous les champs.";
    }
} catch (Exception $e)
{
    echo ('Erreur : ' . $e->getMessage());
}
?>

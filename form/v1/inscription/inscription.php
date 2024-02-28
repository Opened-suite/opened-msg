<?php
session_start();
include_once "../../../config/config_db.php";


try {
    function generateRandomString($length) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    function hash_pass($password, $cost, $method){
        $options = [
            'cost' => $cost
        ];
        return password_hash($password, $method, $options);
    }

    $pseudo = strtolower(htmlspecialchars($_POST["pseudo"]));
    $email = htmlspecialchars($_POST["email"]);
    $password = hash_pass(htmlspecialchars($_POST["password"]), 50, PASSWORD_ARGON2ID);
    $token = generateRandomString(340);
    $ip = $_SERVER["REMOTE_ADDR"];

    // Check if the email or pseudo already exist
    $req = $bdd->prepare("SELECT * FROM users WHERE email = :email OR pseudo = :pseudo");
    $req->execute([
        ":email" => $email,
        ":pseudo" => $pseudo
    ]);
    $existingUser = $req->fetch(PDO::FETCH_ASSOC);

    if (!empty($email) && !empty($password)) {
        if (!$existingUser) {
            $req_inscr = $bdd->prepare("INSERT INTO users (pseudo, email, password, token, ip) VALUES (:pseudo, :email, :password, :token, :ip)");
            $req_inscr->execute([
                ":pseudo" => $pseudo,
                ":email" => $email,
                ":password" => $password,
                ":token" => $token,
                ":ip" => $ip
            ]);
            $req_inscr2 = $bdd->prepare("INSERT INTO contacts (pseudo, contacts) VALUES (:pseudo, :contacts)");
            $req_inscr2->execute([
                ":pseudo" => $pseudo,
                ":contacts" => ""
            ]);
            header("location: ../");
        } else {
            echo "Cet utilisateur existe déjà";
        }
    } else {
        echo "Un problème est survenu";
    }
} catch (Exception $e) {
    echo $e->getMessage();
}
?>

<?php
session_start();
require_once("../config/config_db.php");



if (isset($_SESSION["pseudo"]) && isset($_SESSION["token"])) {

    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
else {
    header("location: /");
}
if (isset($_GET["url"])) {
    $url = $_GET["url"];
}
else {
    header("location: /home/contacts/");
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/calls.css">
    <title>Calls</title>

</head>
<body>
<a class="back" href="javascript:history.back()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5"/>
</svg></a>
    <iframe src="https://meet.jit.si/<?= $pseudo ?>" frameborder="0" width="100%" height="100%"></iframe>
</body>
</html>
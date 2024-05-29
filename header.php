<?php
session_start();
if (isset($_SESSION["pseudo"]) && isset($_SESSION["token"])) {
    $text_pseudo = $_SESSION["pseudo"];
} else {
    $text_pseudo = "Se Connecter";
}

?>
<link rel="stylesheet" href="/style/shared.css">
<div id="centered">
    <nav id="navbar">
        <a href="/"><img src="/OpenedSuite.png" alt=""></a>
        <a href="/home/">Messages</a>
        <a href="/form/">Contact Us</a>
        <a href="/users/"><?= $text_pseudo ?></a>
    </nav>
</div>
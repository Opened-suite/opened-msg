<?php
session_start();
if (isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    $text_pseudo = $_SESSION["pseudo"];
} else {
    $text_pseudo = "Se Connecter";
}

?>
<link rel="stylesheet" href="/style/shared.css">
<div id="centered">
    <nav id="navbar">
        <a href="/">Accueil</a>
        <a href="/home/">Messagerie</a>
        <a href="/form/">Contactez-nous</a>
        <a href="#"><?= $text_pseudo ?></a>
    </nav>
</div>
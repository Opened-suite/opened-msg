<?php
session_start();
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
if (isset($_SESSION["pseudo"]) && isset($_SESSION["token"])) {
    $text_pseudo = $_SESSION["pseudo"];
    $link = "/users/";
} else {
    $text_pseudo = "Se Connecter";
    $link = "/form/";
}

?>
<link rel="stylesheet" href="/style/shared.css">
<div id="centered">
    <nav id="navbar">
        <a href="/"><img src="/OpenedSuite.png" alt=""></a>
        <a href="/home/">Messages</a>
        
        <a href="<?=$link;?>"><?= $text_pseudo ?></a>
    </nav>
</div>
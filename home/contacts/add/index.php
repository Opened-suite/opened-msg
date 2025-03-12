<?php
session_start();
if (!isset($_SESSION["pseudo"]) && $_SESSION["token"]) {
    header("location: /");
} else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}
require_once("../../../config/config_db.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une personne a vos contacts</title>
    <link rel="stylesheet" href="/style/add.css">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/contacts.css">
</head>

<body>
    <?php require_once "../../../header.php" ?>
    <div class="container">
        <form  method="post">
            <label for="pseudo_add">Entrez le nom d'utilisateur</label>
            <input type="text" name="pseudo_add">
            <input type="hidden" name="pseudo" value=<?=$pseudo?>>
            <input type="submit" value="envoyer">
        </form>
    </div>
    <div id="errorPopup" class="popup">
  <div class="popup-content">
    <span class="close">&times;</span>
    <h2>Erreur</h2>
    <p id="errorMessage"></p>
  </div>
</div>

<style>

</style>

<script>
document.querySelector("form").addEventListener("submit", (e) => {
    e.preventDefault();
    
    let pseudo = document.querySelector("input[name=pseudo]").value;
    let pseudo_add = document.querySelector("input[name=pseudo_add]").value;
    
    fetch("/api/users/add/add_user.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: `pseudo=${encodeURIComponent(pseudo)}&pseudo_add=${encodeURIComponent(pseudo_add)}`
    })
    .then(res => {
        if (!res.ok) {
            throw new Error(`Erreur HTTP : ${res.status}`);
        }
        return res.json();
    })
    .then(data => {
        // Supposons que l'API renvoie { success: true, message: "..." } en cas de succès
        if (data.success) {
            // Appliquer une bordure et une box shadow verte sur les champs du formulaire
            const inputs = document.querySelectorAll("input[name=pseudo], input[name=pseudo_add]");
            inputs.forEach(input => {
                input.style.border = "2px solid green";
                input.style.boxShadow = "0 0 10px green";
            });
        } else {
            showErrorPopup(data.error || data.message);
        }
    })
    .catch(error => {
        showErrorPopup(`Erreur lors de la requête : ${error.message}`);
    });
});

function showErrorPopup(message) {
    document.getElementById("errorMessage").textContent = message;
    document.getElementById("errorPopup").style.display = "block";
}

// Fermer la popup quand on clique sur le X
document.querySelector(".close").onclick = function() {
    document.getElementById("errorPopup").style.display = "none";
}

// Fermer la popup si on clique en dehors
window.onclick = function(event) {
    if (event.target == document.getElementById("errorPopup")) {
        document.getElementById("errorPopup").style.display = "none";
    }
}

</script>
</body>

</html>
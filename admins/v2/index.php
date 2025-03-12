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
require_once("../../config/config_db.php");


// Récupération des données
try {
    $req = $bdd->prepare("SELECT * FROM users");
    $req->execute();
    $dataList = $req->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/dashboard.css">
    <script src="/scripts/dashboard.js" defer></script>
    <title>Admin Panel</title>
</head>

<body>
    <h1>Bienvenue <?= $pseudo?></h1>
    <div class="actions">
        <button id="toggletables"><img width="50" height="50" src="https://img.icons8.com/clouds/50/apple-mail.png" alt="apple-mail"/></button>
        <button id="toggleusers"><img width="50" height="50" src="https://img.icons8.com/clouds/50/user.png" alt="user"/></button>
    </div>
    
    <div class="content">
        <div class="discussions hidden">
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

           
            
            try {
                

                // Requête pour récupérer les noms des tables
                $query_already_contacted = "SHOW TABLES";
                $stmt_alr_contacted = $bdd2->prepare($query_already_contacted);
                $stmt_alr_contacted->execute();

                // Parcours des résultats
                while ($row = $stmt_alr_contacted->fetch(PDO::FETCH_ASSOC)) {
                    $tableName = $row['Tables_in_msg'];

                    echo '<a href="javascript:putIframe(`' . $tableName . '`)"><div class="box-contact">
                                <span class="nom">' . $tableName . '/</span>
                            </div></a>';
                }
            } catch (PDOException $e) {
                echo "Erreur : " . $e->getMessage();
            }
            ?>
        </div>
        <div class="users hidden">
            <table>
                
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Pseudo</th>
                    <th scope="col">Email</th>
                    <th scope="col">IP</th>
                    <th scope="col">Grade</th>
                    <th scope="col">Outils</th>

                </tr>
                
                    <?php
                    foreach ($dataList as $data) {
                        echo '<tr>';
                        echo '<td> ' . $data["id"] . ' </td>';
                        echo '<td> ' . $data["pseudo"] . ' </td>';
                        echo '<td> ' . $data["email"] . ' </td>';
                        echo '<td><div class="show hidden"> ' . $data["ip"] . '</div> </td>';
                        echo '<td> ' . $data["grade"] . ' </td>';

                        echo '<td scope="col">
                                    <a href="edit.php?id='.$data["id"].'">
                                        <img width="30" height="30" src="https://img.icons8.com/color/30/edit--v1.png" alt="edit--v1"/>
                                        </a>
                                    <a href="delete.php?id='.$data["id"].'">
                                        <img width="30" height="30" src="https://img.icons8.com/color/30/trash--v1.png" alt="trash--v1"/>
                                    </a>
                                </td>';
                        
                    }
                    echo '<button onclick="ShowDiv" class="fhidden">Montrer Ip</button>';
                    ?>
                    
                
            </table>
        </div>
    </div>
    <div id="close" class="hidden"></div>
    <iframe frameborder="0"></iframe>
    <script src="script.js"></script>
</body>

</html>
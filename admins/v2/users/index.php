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


// Récupération des données
try {
    $req = $bdd->prepare("SELECT * FROM users");
    $reqprevnbusers = $bdd->prepare("SELECT * FROM stats WHERE type = 'nbusers'");
    $reqnbusers = $bdd->prepare("SELECT COUNT(*) FROM users");
    $reqnbadmin = $bdd->prepare("SELECT COUNT(*) FROM users WHERE grade = 'admin'");
    $reqprevnbusers->execute();
    $reqnbadmin->execute();
    $reqnbusers->execute();
    $req->execute();
    $nbadmin = $reqnbadmin->fetchColumn();
    $nbusers = $reqnbusers->fetchColumn();
    $dataList = $req->fetchAll(PDO::FETCH_ASSOC);
    $dataListprev = $reqprevnbusers->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<?php 
    foreach($dataListprev as $data) {
        if ($data['data'] - $nbusers > 0) {
            $diff = $data['data'] - $nbusers;
            $percent = $diff / $data['data'] * 100;
            echo '<script>document.querySelector(".animate-percent").innerHTML = "'.round($percent, 2).'%"</script>';
        }
        else {
            echo '<script>document.querySelector(".animate-percent").innerHTML = "-'.round($percent, 2).'%"</script>';
        }
    }
                    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/style/shared.css">
    <link rel="stylesheet" href="/style/dashboard/users.css">
    <script src="/scripts/dashboard/users.js" defer></script>
    <title>Admin Panel</title>
</head>

<body>
    <h1>Admin Panel - <?= $pseudo ?></h1>
    <div class="stats">
        <div class="card">
        <div class="title">
            <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="user"><path d="M50.4 54.5c10.1 0 18.2-8.2 18.2-18.2S60.5 18 50.4 18s-18.2 8.2-18.2 18.2 8.1 18.3 18.2 18.3zm0-31.7c7.4 0 13.4 6 13.4 13.4s-6 13.4-13.4 13.4S37 43.7 37 36.3s6-13.5 13.4-13.5zM18.8 83h63.4c1.3 0 2.4-1.1 2.4-2.4 0-12.6-10.3-22.9-22.9-22.9H39.3c-12.6 0-22.9 10.3-22.9 22.9 0 1.3 1.1 2.4 2.4 2.4zm20.5-20.5h22.4c9.2 0 16.7 6.8 17.9 15.7H21.4c1.2-8.9 8.7-15.7 17.9-15.7z"></path></svg>            </span>
            <p class="title-text">
                Admin<?php if($nbadmin > 1) echo "s" ?>
            </p>
            <p class="percent">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" fill="currentColor" height="20" width="20">
                    <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                    </path>
                </svg> 20%
            </p>
        </div>
        <div class="data">
            <p>
                <?= $nbadmin ?>
            </p>
            
            <div class="range">
                <div class="fill">
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="title">
                <span class="icon">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 101 101" id="user"><path d="M50.4 54.5c10.1 0 18.2-8.2 18.2-18.2S60.5 18 50.4 18s-18.2 8.2-18.2 18.2 8.1 18.3 18.2 18.3zm0-31.7c7.4 0 13.4 6 13.4 13.4s-6 13.4-13.4 13.4S37 43.7 37 36.3s6-13.5 13.4-13.5zM18.8 83h63.4c1.3 0 2.4-1.1 2.4-2.4 0-12.6-10.3-22.9-22.9-22.9H39.3c-12.6 0-22.9 10.3-22.9 22.9 0 1.3 1.1 2.4 2.4 2.4zm20.5-20.5h22.4c9.2 0 16.7 6.8 17.9 15.7H21.4c1.2-8.9 8.7-15.7 17.9-15.7z"></path></svg>
                </span>
                <p class="title-text">
                    User<?php if($nbusers > 1) echo "s" ?>
                </p>
                <p class="percent">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1792 1792" fill="currentColor" height="20" width="20">
                        <path d="M1408 1216q0 26-19 45t-45 19h-896q-26 0-45-19t-19-45 19-45l448-448q19-19 45-19t45 19l448 448q19 19 19 45z">
                        </path>
                    </svg> 
                    <span class="animate-percent"></span>
                </p>
            </div>
            <div class="data">
                <p>
                    <?= $nbusers ?> 
                </p>
                
                <div class="range">
                    <div class="fill">
                    </div>
                </div>
            </div>
    </div>
        

    </div>
    <div class="actions">
        <button id="toggleusers"><img width="50" height="50" src="https://img.icons8.com/clouds/50/user.png" alt="user"/></button>
    </div>
    
    <div class="content">
        
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
                        echo '<td>' . $data["ip"] . '</div> </td>';
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
                    ?>
                    
                
            </table>
        </div>
    </div>
    
</body>

</html>
<?php
session_start();
require_once("../../config/config_db.php");





    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
    $table = htmlspecialchars($_GET["table"]);



$query_usr = 'SELECT usr1, usr2 FROM schema_table WHERE tablename = "' . $_GET["table"] . '"';
$stmt_usr = $bdd2->prepare($query_usr);
$stmt_usr->execute();
$result_usr = $stmt_usr->fetch(PDO::FETCH_ASSOC);
if ($result_usr["usr1"] != $pseudo && $result_usr["usr2"] != $pseudo) {
    header("location: /");
}
elseif ($result_usr["usr1"] == $pseudo) {
    $usr = $result_usr["usr2"];
}
elseif ($result_usr["usr2"] == $pseudo) {
    $usr = $result_usr["usr1"];

}
?>
  
        <meta charset="UTF-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>OpenedMSG</title>
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script src="/home/home.js"></script>

        <link rel="stylesheet" href="/style/home.css">
        <link rel="stylesheet" href="/style/shared.css">
        <nav class="discnav" id="nav">
            <span class="info">
                <a href="">
                    <div class="see">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-person" viewBox="0 0 16 16">
                        <path d="M12 1a1 1 0 0 1 1 1v10.755S12 11 8 11s-5 1.755-5 1.755V2a1 1 0 0 1 1-1zM4 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                        <path d="M8 10a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>
                        </svg>
                    </div>
                </a>
            </span>
            <span class="usr">
                <div class="usr-img"><img width="30" height="30" src="https://img.icons8.com/color/30/user-male-circle--v1.png" alt="user-male-circle"/></div>
                <div class="usr-name"><?= $usr ?></div>
            </span>
            <span class="tools">
                <a href="/calls/send.php?url=<?= $pseudo ?>&?table=<?= $table ?>&?usr=<?= $usr ?>">
                <div class="call">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-telephone" viewBox="0 0 16 16">
                    <path d="M3.654 1.328a.678.678 0 0 0-1.015-.063L1.605 2.3c-.483.484-.661 1.169-.45 1.77a17.6 17.6 0 0 0 4.168 6.608 17.6 17.6 0 0 0 6.608 4.168c.601.211 1.286.033 1.77-.45l1.034-1.034a.678.678 0 0 0-.063-1.015l-2.307-1.794a.68.68 0 0 0-.58-.122l-2.19.547a1.75 1.75 0 0 1-1.657-.459L5.482 8.062a1.75 1.75 0 0 1-.46-1.657l.548-2.19a.68.68 0 0 0-.122-.58zM1.884.511a1.745 1.745 0 0 1 2.612.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z"/>
                    </svg>
                </div>
                </a>
                <a href="">
                <div class="vid-call">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera-video" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 5a2 2 0 0 1 2-2h7.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 4.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 13H2a2 2 0 0 1-2-2zm11.5 5.175 3.5 1.556V4.269l-3.5 1.556zM2 4a1 1 0 0 0-1 1v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V5a1 1 0 0 0-1-1z"/>
                    </svg>
                </div>
                </a>
                <a href="">
                <div class="mess-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat-left" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
                    </svg>
                </div>
                </a>
                <a href="">
                <div class="user-dash">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-dash" viewBox="0 0 16 16">
                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M11 12h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1 0-1m0-7a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4"/>
                    <path d="M8.256 14a4.5 4.5 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10q.39 0 .74.025c.226-.341.496-.65.804-.918Q8.844 9.002 8 9c-5 0-6 3-6 4s1 1 1 1z"/>
                    </svg>
                </div>
                </a>
                <a href="">
                <div class="ban">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-ban" viewBox="0 0 16 16">
                    <path d="M15 8a6.97 6.97 0 0 0-1.71-4.584l-9.874 9.875A7 7 0 0 0 15 8M2.71 12.584l9.874-9.875a7 7 0 0 0-9.874 9.874ZM16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0"/>
                    </svg>
                </div>
                </a>
            </span>
            
        </nav>
        <div id="messages">

<?php
if (!isset($_SESSION["pseudo"]) && !isset($_SESSION["token"])) {
    header("location: /");
}
else {
    $pseudo = $_SESSION["pseudo"];
    $token = $_SESSION["token"];
    $email = $_SESSION["email"];
    $ip = $_SESSION["ip"];
}


try {
    require_once("../../config/config_db.php");

    // Check si il est admin
    $query_admin = 'SELECT `grade` FROM `users` WHERE `pseudo` = "' . $pseudo. '"';
    $stmt_admin = $bdd->prepare($query_admin);
    $stmt_admin->execute();
    $grade = $stmt_admin->fetchAll(PDO::FETCH_ASSOC);

    
    // Requête pour récupérer les messages de la table spécifiée
    $query_get_messages = 'SELECT * FROM '. $table;
    $stmt_messages = $bdd2->prepare($query_get_messages);
    $stmt_messages->execute();
    $messages = $stmt_messages->fetchAll(PDO::FETCH_ASSOC);

    foreach ($messages as $message) {
        if ($message["by_send"] == $pseudo) { 
            if ($message["attachement"] != NULL) {
                echo  '<div class="you msg"><div class="animation-wrapper">' . $message["msg"] . '</div><span class="date">'  . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '<div class="animation-wrapper"><img src="/home/discussion/img/' . $message["attachement"] . '" alt="attachement" class="attachement">' . '</div></div>';
            }
            else {
                echo '<div class="you msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
            }
            
        }
        elseif($message["by_send"] == "admin") {
            if ($message["attachement"] != NULL) {
                echo '<div class="other msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '<img src="/home/discussion/img/' . $message["attachement"] . '" alt="attachement" class="attachement">' . '</div>';
            }
            else {
                echo '<div class="other msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
            }
            
        }
        else {
            if ($message["attachement"] != NULL) {
                echo '<div class="other msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '<img src="/home/discussion/img/' . $message["attachement"] . '" alt="attachement" class="attachement">' . '</div>';
            }
            else {
                echo '<div class="other msg">' . $message["msg"] . "<span class='date'>" . date('m/d/Y &#9679; H:i:s', $message["time_send"]) . '</span>' . '</div>';
            }
        }

        $lastmsg = $message["id"];
        
        
    }
    
    
}   
catch (PDOException $e) {
    echo "Erreur de connexion à la base de données : " . $e->getMessage();
}

?>
<script>
        document.getElementById('messages').scrollTop = document.getElementById('messages').scrollHeight;
        </script>

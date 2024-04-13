<?php

// Configuration du client
$host = '127.0.0.1'; // Adresse IP du serveur
$port = 65432;       // Port du serveur

// Création du socket TCP/IP
$socket = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);
if ($socket === false) {
    echo "Erreur lors de la création du socket : " . socket_strerror(socket_last_error()) . "\n";
    exit(1);
}

// Établissement de la connexion avec le serveur
$result = socket_connect($socket, $host, $port);
if ($result === false) {
    echo "Erreur lors de la connexion au serveur : " . socket_strerror(socket_last_error($socket)) . "\n";
    exit(1);
}

// Envoi de données au serveur
$message = "Hello, serveur!";
socket_write($socket, $message, strlen($message));

// Lit la réponse du serveur
$response = socket_read($socket, 1024);
echo "Reçu : " . $response . "\n";

// Ferme le socket
socket_close($socket);
?>

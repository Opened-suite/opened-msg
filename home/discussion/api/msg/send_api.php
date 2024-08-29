<?php
require __DIR__ . '/vendor/autoload.php';

use WebSocket\Client;

function notifyNewMessage($table)
{
    try {
        $client = new Client("ws://localhost:8001");
        $message = json_encode(['table' => $table]);
        $client->send($message);
        $response = $client->receive();
        
    } catch (Exception $e) {
        error_log("Erreur lors de l'envoi au WebSocket: " . $e->getMessage());
    }
}

// Test
notifyNewMessage('messages_utilisateur_1');
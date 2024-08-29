<?php
require __DIR__ . '/vendor/autoload.php';

use Ratchet\Server\IoServer;
use Ratchet\Http\HttpServer;
use Ratchet\WebSocket\WsServer;
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;

class MessageNotificationSocket implements MessageComponentInterface
{
    protected $clients;

    public function __construct()
    {
        $this->clients = new \SplObjectStorage;
        echo "Serveur WebSocket démarré\n";
    }

    public function onOpen(ConnectionInterface $conn)
    {
        $this->clients->attach($conn);
        echo "Nouvelle connexion! ({$conn->resourceId})\n";
    }

    public function onMessage(ConnectionInterface $from, $msg)
    {
        echo "Message reçu: $msg\n";
        $data = json_decode($msg, true);
        if (isset($data['table'])) {
            echo "Notification pour la table: {$data['table']}\n";
            foreach ($this->clients as $client) {
                $client->send(json_encode(['table' => $data['table'], 'new_message' => true]));
            }
        }
    }

    public function onClose(ConnectionInterface $conn)
    {
        $this->clients->detach($conn);
        echo "Connexion {$conn->resourceId} fermée\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e)
    {
        echo "Une erreur est survenue: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Configuration et démarrage du serveur
$server = IoServer::factory(
    new HttpServer(
        new WsServer(
            new MessageNotificationSocket()
        )
    ),
    8001
);

echo "Serveur WebSocket démarré sur le port 8001\n";
$server->run();
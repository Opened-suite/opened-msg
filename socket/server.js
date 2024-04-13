const express = require('express');
const http = require('http');
const socketIO = require('socket.io');

const PORT = process.env.PORT || 3000;
const app = express();
const server = http.createServer(app);
const io = socketIO(server);

app.use(express.static(__dirname + '/public'));

io.on('connection', (socket) => {
    console.log('New connection:', socket.id);

    // Envoyer la liste des utilisateurs connectés à tous les clients
    io.emit('updateUserList', getUsers());

    // Événement pour gérer la déconnexion d'un utilisateur
    socket.on('disconnect', () => {
        console.log('User disconnected:', socket.id);
        io.emit('updateUserList', getUsers());
    });
});

// Fonction pour récupérer la liste des utilisateurs connectés
function getUsers() {
    const users = [];
    Object.keys(io.sockets.sockets).forEach((socketId) => {
        const socket = io.sockets.sockets[socketId];
        users.push(socket.handshake.address);
    });
    return users;
}

server.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});

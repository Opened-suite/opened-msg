let socket;
let currentTable;

function initMessageHandler(table) {
    currentTable = table;
    socket = new WebSocket('ws://localhost:8001');

    socket.onopen = function(event) {
        console.log("WebSocket connecté");
        markAllMessagesAsSeen();
    };

    socket.onerror = function(error) {
        console.error("Erreur WebSocket:", error);
    };

    socket.onmessage = function(event) {
        console.log("Message reçu:", event.data);
        const data = JSON.parse(event.data);
        if (data.type === 'new_message' && data.table === currentTable) {
            window.parent.location.reload(); // Recharger la page parente pour afficher le nouveau message
        } else if (data.type === 'message_seen') {
            updateMessageStatus(data.messageId, 'seen');
        }
    };
}

function updateMessageStatus(messageId, status) {
    const messageElement = document.querySelector(`[data-message-id="${messageId}"]`);
    if (messageElement) {
        const statusIcon = messageElement.querySelector('.message-status');
        if (statusIcon) {
            if (status === 'seen') {
                statusIcon.innerHTML = '✅'; // Icône pour "vu"
            }
        }
    }
}

function markAllMessagesAsSeen() {
    const messages = document.querySelectorAll('.message.received');
    messages.forEach(message => {
        const messageId = message.getAttribute('data-message-id');
        socket.send(JSON.stringify({
            type: 'mark_seen',
            messageId: messageId
        }));
    });
}
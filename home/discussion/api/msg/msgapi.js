const socket = new WebSocket('ws://78.192.172.224:8001');
const userTable = "messages_utilisateur_1"

socket.onopen = function(event) {
    console.log("WebSocket connecté");
};

socket.onerror = function(error) {
    console.error("Erreur WebSocket:", error);
};

socket.onmessage = function(event) {
    console.log("Message reçu:", event.data);
    const data = JSON.parse(event.data);
    if (data.table === userTable && data.new_message) {
        console.log("Actualisation de l'iframe");
        document.getElementById('msgframe').contentWindow.location.reload();
    }
};
const socket = new WebSocket('ws://78.192.172.224:8001');


socket.onopen = function(event) {
    console.log("WebSocket connecté");
}
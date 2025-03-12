


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Player Status</title>
    <style>
        .player {
            display: flex;
            align-items: center;
            margin: 5px 0;
        }
        .status {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }
        .online {
            background-color: green;
        }
        .offline {
            background-color: gray;
        }
    </style>
</head>
<body>
    <h1>Connected Players</h1>
    <div id="player-list"></div>

    <script>
    const username = "<?php echo $_SESSION['username'] ?? 'Guest'; ?>";
    const ws = new WebSocket('ws://localhost:8080');
    const playerList = document.getElementById('player-list');

    ws.onopen = () => {
        ws.send(JSON.stringify({ action: 'connect', username }));
    };

    ws.onmessage = (event) => {
        const data = JSON.parse(event.data);

        if (data.action === 'update_status') {
            updatePlayerList(data.players);
        }
    };

    ws.onbeforeunload = () => {
        ws.send(JSON.stringify({ action: 'disconnect', username }));
        ws.close();
    };

    function updatePlayerList(players) {
        playerList.innerHTML = '';

        players.forEach(player => {
            const playerDiv = document.createElement('div');
            playerDiv.classList.add('player');

            const statusDiv = document.createElement('div');
            statusDiv.classList.add('status', player.status ? 'online' : 'offline');

            const nameSpan = document.createElement('span');
            nameSpan.textContent = player.username;

            playerDiv.appendChild(statusDiv);
            playerDiv.appendChild(nameSpan);

            playerList.appendChild(playerDiv);
        });
    }
</script>

</body>
</html>

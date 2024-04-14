let valuejs = document.querySelector(".valuejs");
let valuetable = document.querySelector(".valuetablejs");
let iframemsg = document.querySelector(".iframemsg");
iframemsg.scrollTop = iframemsg.scrollHeight;
setInterval(() => {
    fetch(`api/msg/msgapi.php?table=${valuetable.innerHTML}`)
        .then(function(response) {
            if (!response.ok) {
                throw new Error("La réponse n'est pas OK. Statut : " + response.status);
            }
            return response.json();
        })
        .then(function(data) {
            if (data !== Number(valuejs.innerText)) {
				iframemsg.location = iframemsg.location;
            }
        })
        .catch(function(error) {
            console.error("Erreur :", error);
        });
}, 100);


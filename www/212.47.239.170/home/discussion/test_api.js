let valuejs = document.querySelector(".valuejs")
let valuetable = document.querySelector(".valuetablejs")

setInterval(() => {
	fetch(`api.php?table=${valuetable.innerHTML}`)
		.then(function(response) {
			if (!response.ok) {
				throw new Error("La réponse n'est pas OK. Statut : " + response.status);
			}
			return response.json();
		})
		.then(function(data) {
			if (data !== Number(valuejs.innerHTML)) {
				location.href = location.href;
			}
		})
		.catch(function(error) {
			console.error("Erreur :", error);
		});
}, 1000);

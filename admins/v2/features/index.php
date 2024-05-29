<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Features - Admin</title>
</head>
<body>
<div class="toggler">
    <input id="toggler-1" name="toggler-1" type="checkbox" value="1">
    <label for="toggler-1">
        <svg class="toggler-on" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
            <polyline class="path check" points="100.2,40.2 51.5,88.8 29.8,67.5"></polyline>
        </svg>
        <svg class="toggler-off" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 130.2 130.2">
            <line class="path line" x1="34.4" y1="34.4" x2="95.8" y2="95.8"></line>
            <line class="path line" x1="95.8" y1="34.4" x2="34.4" y2="95.8"></line>
        </svg>
    </label>
</div>
</body>
<script>
const toggler = document.getElementById('toggler-1');
const fileContent = 'test.txt';

// Lire le contenu du fichier pour définir l'état initial du toggler
const xhr = new XMLHttpRequest();
xhr.open('GET', 'readstatus.php', true);
xhr.onload = function() {
  if (xhr.status === 200) {
    const fileContentValue = xhr.responseText.trim();
    toggler.checked = fileContentValue === 'true';
  }
};
xhr.send();

toggler.addEventListener('change', () => {
  const isChecked = toggler.checked;
  const fileContentValue = isChecked ? 'true' : 'false';

  // Crée un objet XMLHttpRequest pour envoyer une requête HTTP
  const xhr = new XMLHttpRequest();
  xhr.open('GET', 'changestatus.php?content=' + fileContentValue, true);
  xhr.send();
});
</script>
</html>
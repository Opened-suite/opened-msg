<?php
$config = json_decode(file_get_contents("../config.json"), true);


// Get First Route
$general = $config["general"];
$db = $config["db"];

// Get Second Route


// General route
$name = $general["name"];
$logopath = $general["logopath"];


// Db route 
$user_db = $db["user"];
$password_db = $db["password"];
?>
<?php
require_once 'check_auth.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>4 Projet</title>
<link rel="stylesheet" href="log.css">
</head>
<body>

<!-- Use a <form> or a div with class="loginForm" to match your CSS -->
<form class="loginForm">
    <h2>Main papge</h2>

    <label for="formulaire">Formulaire</label>
    <button type="button" onclick="location.href='formulaire.php'">Formulaire</button>

    <label for="affichage">Affichage</label>
    <button type="button" onclick="location.href='affichage.php'">Affichage</button>

    <label for="affichage">Log out</label>
    <button type="button" onclick="location.href='logout.php'">Log out</button>
</form>

</body>
</html>

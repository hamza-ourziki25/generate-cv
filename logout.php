<?php
// logout.php

// Démarrer la session pour pouvoir la manipuler
session_start();

// Si un cookie de session existe, forcer son expiration côté client
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Nettoyer les variables de session
session_unset();

// Détruire la session côté serveur
session_destroy();

// Rediriger vers la page de login
header('Location: login_front.php');
exit;
?>
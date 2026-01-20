<?php
// check_auth.php - Version avec débogage
session_start();

// Debug mode
$debug = true;

if ($debug) {
    error_log("=== CHECK AUTH ===");
    error_log("Session ID: " . session_id());
    error_log("Session data: " . json_encode($_SESSION));
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['id_log'])) {
    if ($debug) {
        error_log("❌ Utilisateur non connecté - Redirection vers login");
    }
    header('Location: login_front.php');
    exit;
}

if ($debug) {
    error_log("✅ Utilisateur connecté - ID: " . $_SESSION['id_log']);
}

// Vérifier expiration de session (1 heure)
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 3600)) {
    if ($debug) {
        error_log("⏰ Session expirée");
    }
    session_unset();
    session_destroy();
    header('Location: login_front.php?expired=1');
    exit;
}

// Mettre à jour le timestamp
$_SESSION['last_activity'] = time();

if ($debug) {
    error_log("Session mise à jour - Dernière activité: " . $_SESSION['last_activity']);
}
?>
<?php
session_start();

header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, X-Requested-With');

// TURN OFF ERROR DISPLAY (important!)
ini_set('display_errors', 0);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

try {
    require_once 'conect.php';

    $raw = file_get_contents('php://input');
    if (!$raw) {
        echo json_encode(['success' => false, 'message' => 'Empty request']);
        exit;
    }

    $data = json_decode($raw, true);
    if ($data === null) {
        echo json_encode(['success' => false, 'message' => 'Invalid JSON']);
        exit;
    }

    if (empty($data['username']) || empty($data['password'])) {
        echo json_encode(['success' => false, 'message' => 'Username and password required']);
        exit;
    }

    $username = trim($data['username']);
    $password = trim($data['password']);

    // Query database
    $sql = "SELECT id_log, username, password FROM login WHERE username = :username LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$user) {
        echo json_encode(['success' => false, 'message' => 'Username not found']);
        exit;
    }

    // Verify password
    if (password_verify($password, $user['password'])) {
        $_SESSION['id_log'] = $user['id_log'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['login_time'] = time();
        $_SESSION['last_activity'] = time();

        echo json_encode([
            'success' => true,
            'message' => 'Login successful',
            'user_id' => $user['id_log']
        ]);
        exit;
    }

    echo json_encode(['success' => false, 'message' => 'Incorrect password']);
    exit;

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Server error: ' . $e->getMessage()]);
    exit;
}
?>
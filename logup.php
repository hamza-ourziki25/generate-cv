<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'conect.php'; // your PDO connection

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success'=>false, 'message'=>'Méthode non autorisée']);
    exit;
}

try {
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) throw new Exception('Données JSON invalides');

    // Validate fields
    $required = ['fullname', 'username', 'password'];
    foreach($required as $field){
        if(empty($data[$field])) throw new Exception("Le champ '$field' est obligatoire");
    }

    // Optional: hash password
    $passwordHash = password_hash($data['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO login (full_name, username, password) 
            VALUES (:fullname, :username, :password)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':fullname' => $data['fullname'],
        ':username' => $data['username'],
        ':password' => $passwordHash
    ]);

    echo json_encode([
        'success' => true,
        'message' => 'Compte créé avec succès !',
        'user_id' => $pdo->lastInsertId()
    ]);

} catch(Exception $e) {
    echo json_encode([
        'success'=>false,
        'message'=>'Erreur: '.$e->getMessage()
    ]);
}
?>

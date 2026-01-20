<?php
// DON'T call session_start() - check_auth.php does it
require_once 'check_auth.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

ini_set('display_errors', 0);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Method not allowed']);
    exit;
}

try {
    require_once 'conect.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (!$data) {
        throw new Exception('Invalid JSON');
    }

    $id_log = $_SESSION['id_log'] ?? null;
    if (!$id_log) {
        throw new Exception('User not authenticated');
    }

    $required = ['nom', 'email', 'telephone', 'adresse', 'description', 'design'];
    foreach ($required as $field) {
        if (empty($data[$field])) {
            throw new Exception("Field '$field' is required");
        }
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Invalid email');
    }

    $pdo->beginTransaction();

    $sql = "INSERT INTO cvs (id_log, nom, photo, email, telephone, adresse, description, certificats, loisirs, skills, design) 
            VALUES (:id_log, :nom, :photo, :email, :telephone, :adresse, :description, :certificats, :loisirs, :skills, :design)";
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':id_log' => $id_log,
        ':nom' => $data['nom'],
        ':photo' => $data['photo'] ?? '',
        ':email' => $data['email'],
        ':telephone' => $data['telephone'],
        ':adresse' => $data['adresse'],
        ':description' => $data['description'],
        ':certificats' => $data['certificats'] ?? '',
        ':loisirs' => $data['loisirs'] ?? '',
        ':skills' => $data['skills'] ?? '',
        ':design' => $data['design']
    ]);

    $cv_id = $pdo->lastInsertId();

    if (!empty($data['diplomes']) && is_array($data['diplomes'])) {
        $sqlDiplome = "INSERT INTO diplomes (cv_id, name, start_date, end_date) VALUES (:cv_id, :name, :start_date, :end_date)";
        $stmtDiplome = $pdo->prepare($sqlDiplome);

        foreach ($data['diplomes'] as $diplome) {
            if (!empty($diplome['name']) && !empty($diplome['start'])) {
                $stmtDiplome->execute([
                    ':cv_id' => $cv_id,
                    ':name' => $diplome['name'],
                    ':start_date' => $diplome['start'],
                    ':end_date' => $diplome['end'] ?? null
                ]);
            }
        }
    }

    if (!empty($data['experiences']) && is_array($data['experiences'])) {
        $sqlExp = "INSERT INTO experiences (cv_id, entreprise, description, start_date, end_date) 
                   VALUES (:cv_id, :entreprise, :description, :start_date, :end_date)";
        $stmtExp = $pdo->prepare($sqlExp);

        foreach ($data['experiences'] as $exp) {
            if (!empty($exp['entreprise']) && !empty($exp['description']) && !empty($exp['start'])) {
                $stmtExp->execute([
                    ':cv_id' => $cv_id,
                    ':entreprise' => $exp['entreprise'],
                    ':description' => $exp['description'],
                    ':start_date' => $exp['start'],
                    ':end_date' => $exp['end'] ?? null
                ]);
            }
        }
    }

    if (!empty($data['langues']) && is_array($data['langues'])) {
        $sqlLangue = "INSERT INTO langues (cv_id, langue_name, niveau) 
                      VALUES (:cv_id, :langue_name, :niveau)";
        $stmtLangue = $pdo->prepare($sqlLangue);

        foreach ($data['langues'] as $langue) {
            if (!empty($langue['name']) && !empty($langue['niveau'])) {
                $stmtLangue->execute([
                    ':cv_id' => $cv_id,
                    ':langue_name' => $langue['name'],
                    ':niveau' => $langue['niveau']
                ]);
            }
        }
    }

    $pdo->commit();

    echo json_encode([
        'success' => true,
        'message' => 'CV saved successfully!',
        'cv_id' => $cv_id
    ]);

} catch (Exception $e) {
    if ($pdo->inTransaction()) {
        $pdo->rollBack();
    }
    
    echo json_encode([
        'success' => false,
        'message' => 'Error: ' . $e->getMessage()
    ]);
}
?>
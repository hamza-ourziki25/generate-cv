<?php


header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once 'conect.php';

try {
    // Vérifier si on demande un CV spécifique
    $cv_id = isset($_GET['id']) ? intval($_GET['id']) : null;

    if ($cv_id) {
        // Récupérer un CV spécifique avec ses diplômes et expériences
        $sql = "SELECT * FROM cvs WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':id' => $cv_id]);
        $cv = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cv) {
            throw new Exception('CV non trouvé');
        }

        // Récupérer les diplômes
        $sqlDiplomes = "SELECT * FROM diplomes WHERE cv_id = :cv_id ORDER BY start_date DESC";
        $stmtDiplomes = $pdo->prepare($sqlDiplomes);
        $stmtDiplomes->execute([':cv_id' => $cv_id]);
        $cv['diplomes'] = $stmtDiplomes->fetchAll(PDO::FETCH_ASSOC);

        // Récupérer les expériences
        $sqlExp = "SELECT * FROM experiences WHERE cv_id = :cv_id ORDER BY start_date DESC";
        $stmtExp = $pdo->prepare($sqlExp);
        $stmtExp->execute([':cv_id' => $cv_id]);
        $cv['experiences'] = $stmtExp->fetchAll(PDO::FETCH_ASSOC);

        // 🛑 NOUVEAU BLOC : Récupérer les langues depuis la table 'langues'
        $sqlLangues = "SELECT langue_name, niveau FROM langues WHERE cv_id = :cv_id";
        $stmtLangues = $pdo->prepare($sqlLangues);
        $stmtLangues->execute([':cv_id' => $cv_id]);
        $cv['langues'] = $stmtLangues->fetchAll(PDO::FETCH_ASSOC); // $cv['langues'] est maintenant un tableau d'objets

        echo json_encode([
            'success' => true,
            'cv' => $cv
        ]);

    } else {
        // Récupérer tous les CVs (liste)
        $sql = "SELECT id, nom, email, telephone, design, created_at FROM cvs ORDER BY created_at DESC";
        $stmt = $pdo->query($sql);
        $cvs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        echo json_encode([
            'success' => true,
            'cvs' => $cvs,
            'total' => count($cvs)
        ]);
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => 'Erreur: ' . $e->getMessage()
    ]);
}
?>
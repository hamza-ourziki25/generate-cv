<?php
// delete_cv.php

// 1. Enforce Authentication
require_once 'check_auth.php';
require_once 'conect.php';

// Set headers for JSON response
header('Content-Type: application/json');

// Check for POST request and CV ID
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cv_id'])) {
    $cv_id = $_POST['cv_id'];

    // Validate the ID
    if (!is_numeric($cv_id) || $cv_id <= 0) {
        echo json_encode(['success' => false, 'message' => 'Invalid CV ID.']);
        exit;
    }

    try {
        // Use a prepared statement to prevent SQL Injection
        $sql = "DELETE FROM cvs WHERE id = :cv_id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([':cv_id' => $cv_id]);

        // Check if a row was actually deleted
        if ($stmt->rowCount() > 0) {
            echo json_encode(['success' => true, 'message' => 'CV deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'No CV found with this ID.']);
        }

    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method or missing ID.']);
}
?>
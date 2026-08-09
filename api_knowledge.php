<?php
require_once 'config/database.php';
header('Content-Type: application/json');

try {
    $stmt = $pdo->query("SELECT keywords, response FROM dors_knowledge ORDER BY id DESC");
    $knowledge = $stmt->fetchAll();
    
    $formattedKnowledge = [];
    foreach ($knowledge as $k) {
        $kwArray = array_map('trim', explode(',', $k['keywords']));
        $formattedKnowledge[] = [
            'keywords' => $kwArray,
            'response' => $k['response']
        ];
    }
    
    echo json_encode(["status" => "success", "data" => $formattedKnowledge]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(["status" => "error", "message" => "Database error"]);
}
?>

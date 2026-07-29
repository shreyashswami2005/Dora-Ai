<?php
require 'config/database.php';
echo "<h2>DB Connection Test</h2>";
echo "Connected successfully to: " . htmlspecialchars($dbname ?? 'unknown') . "<br>";

// List tables
$tables = $pdo->query('SHOW TABLES;')->fetchAll(PDO::FETCH_COLUMN);
echo "<p>Tables: " . (empty($tables) ? 'NONE' : implode(', ', $tables)) . "</p>";

// Test users table
try {
    $stmt = $pdo->query("SELECT COUNT(*) FROM users;");
    echo "<p>Users count: " . $stmt->fetchColumn() . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>Users table error: " . $e->getMessage() . "</p>";
}
?>

<?php
require 'config/database.php';

$sql = file_get_contents('database.sql');

try {
    // Execute multiple queries
    $pdo->exec($sql);
    echo "Successfully created all tables from database.sql (including users)!";
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

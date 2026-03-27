<?php
$host = 'localhost';
$username = 'root';
$password = '1234';
$dbname = 'farmer_marketplace';

try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $pdo->exec("CREATE DATABASE IF NOT EXISTS `$dbname`");
    echo "Database created or exists.\n";
    
    $pdo->exec("USE `$dbname`");
    
    $stmt = $pdo->query("SHOW TABLES");
    if ($stmt->rowCount() == 0) {
        echo "No tables found. Importing database.sql...\n";
        $sql = file_get_contents('database.sql');
        
        // Split SQL statements to execute them properly if PDO->exec fails on multiple
        $pdo->exec($sql);
        echo "Imported database.sql.\n";
    } else {
        echo "Tables already exist.\n";
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage() . "\n");
}
?>

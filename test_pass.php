<?php
$host = 'localhost';
$username = 'root';
$passwords = ['', 'root', 'admin', 'password', '1234', '12345', '123456', '12345678', '123456789', 'mysql'];

foreach ($passwords as $p) {
    try {
        $pdo = new PDO("mysql:host=$host", $username, $p);
        echo "SUCCESS WITH PASSWORD: '$p'\n";
        exit(0);
    } catch (PDOException $e) {
        // failed
    }
}

// Also try different usernames
$users = ['mysql', 'admin', 'test'];
foreach ($users as $u) {
    foreach ($passwords as $p) {
        try {
            $pdo = new PDO("mysql:host=$host", $u, $p);
            echo "SUCCESS WITH USER: '$u', PASSWORD: '$p'\n";
            exit(0);
        } catch (PDOException $e) {
            // failed
        }
    }
}

echo "ALL FAILED\n";

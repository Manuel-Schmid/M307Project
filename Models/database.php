<?php
$dsn = 'mysql:host=localhost;dbname=m307db';
$username = 'HibKanbAdmin';
$password = 'e507y';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = 'Database Error: ';
    $error_message .= $e->getMessage();
    echo $error_message;
    exit();
}


<?php
$dsn = 'mysql:host=213.196.190.205;dbname=M307DB';
$username = 'M307admin';
$password = 'e507y';

try {
    $pdo = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    $error_message = 'Database Error: ';
    $error_message .= $e->getMessage();
    echo $error_message;
    exit();
}

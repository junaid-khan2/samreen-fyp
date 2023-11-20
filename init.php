<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BASE_URL', 'http://localhost/samreen-fyp');



/// Session Checking
session_start();
$currentUri = $_SERVER['REQUEST_URI'];
$currentBase = basename($currentUri);
$currentDir = dirname($currentUri);
if ($currentBase !== 'login.php' && strpos($currentDir, '/dashboard') !== false) {
    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
        header("Location: ".BASE_URL."/dashboard/login.php");
        exit;
    }
}


/// Connect Database
$host = 'localhost';
$db = 'event_management1';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
try {
    $database = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int) $e->getCode());
}

?>
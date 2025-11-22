<?php
// Start session
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../class/Database.php';
require_once __DIR__ . '/../class/User.php';

$host = 'localhost';
$dbname = 'crud_mahasiswa'; 
$username = 'root';
$password = '';

// buat objek database
$database = new Database($host, $dbname, $username, $password);
$db = $database->getConnection();

// Define base URL
$base_url = ''; 

// navigasi config
    
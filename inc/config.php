<?php

// Start session
session_start();

// simple autoload
spl_autoload_register(function($class) {
    $file = __DIR__ . '/../class/' . $class . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});

// database config
$host = 'localhost';
$dbname = ''; // nama database nanti isi setelah fix
$username = 'root';
$password = '';

// Define base URL
$base_url = ''; // nanti sesuaikan dengan folder project

// navigasi config
    
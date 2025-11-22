<?php

// require necessary files

require_once 'inc/config.php';

// testing code

$db = new Database($host, $dbname, $username, $password);
$conn = $db->getConnection();

echo "Koneksi sukses!";

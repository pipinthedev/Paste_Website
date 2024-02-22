<?php

error_reporting(E_ALL);
// configuration
$secret_key = "5fb6e0d1b9ad8782ddc30c914d47468586926907b3d1e4517e0d1d350af2efe3";
$secret_iv = "48e5e4240ad0e2f6558d2faa0de4b180";
$encrypt_method = "AES-256-CBC";


//db connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pastebin";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>
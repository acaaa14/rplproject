<?php
$servername = "localhost"; // Server database
$username = "root";        // Username database
$password = "rosita123";            // Password database
$dbname = "cake_pop_db";   // Nama database

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Cek koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

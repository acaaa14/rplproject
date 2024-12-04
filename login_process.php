<?php
session_start(); // Memulai sesi

// Hubungkan ke database
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Enkripsi password yang diterima
    $encrypted_password = md5($password);

    // Query untuk memeriksa email dan password
    $query = "SELECT * FROM users WHERE email = ? AND password = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ss", $email, $encrypted_password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika login berhasil
        $_SESSION['user'] = $result->fetch_assoc();
        header("Location: index.php"); // Redirect ke index.php
        exit();
    } else {
        // Jika login gagal
        echo "Invalid email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

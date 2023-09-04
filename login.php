<?php
session_start();

// Konfigurasi koneksi ke database (ganti dengan informasi database Anda)
$host = "localhost";
$username = "username";
$password = "password";
$database = "yayaya";

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $yayaya);



// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Mengambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan query untuk memeriksa login
$query = "SELECT * FROM yayaya WHERE username='$username' AND password='$password'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Login berhasil
    $_SESSION['username'] = $username;
    $userRole = 'user'; // Set peran pengguna sebagai 'user'
    // Lanjutkan dengan tindakan setelah login berhasil
} else {
    // Login gagal
    header('Location: login.php?error=1'); // Redirect kembali ke halaman login dengan pesan error
    exit();
}

// Menutup koneksi ke database
$conn->close();

// Pengecekan peran pengguna dan pengalihan halaman
if ($userRole === 'admin') {
    // Tampilkan konten untuk admin
    header('Location: index.html'); // Redirect ke halaman admin_home.php
    exit();
} else {
    // Pengguna hanya bisa mengakses halaman Home
    header('Location: home.php'); // Redirect ke halaman home.php
    exit();
}
?>

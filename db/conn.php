<?php
// Informasi koneksi ke database
$servername = "localhost"; // Ganti dengan hostname server database Anda
$username = "root"; // Ganti dengan username database Anda
$dbname = "perpustakaan"; // Ganti dengan nama database Anda

// Buat koneksi
$conn = new mysqli($servername, $username, '', $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}   
?>

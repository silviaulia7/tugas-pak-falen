<?php
session_start();
include "conn.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit();
}

// Cek role (hanya admin yang boleh hapus)
if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        alert('Akses ditolak! Hanya admin yang bisa menghapus data user.');
        window.location='user.php';
    </script>";
    exit();
}

// Pastikan parameter id dikirim
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
        alert('Parameter ID tidak ditemukan!');
        window.location='user.php';
    </script>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Jalankan query hapus
$deleteQuery = "DELETE FROM user WHERE Customer_ID='$id'";

if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
        alert('Data user berhasil dihapus!');
        window.location='user.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('Gagal menghapus data: " . mysqli_error($conn) . "');
        window.location='user.php';
    </script>";
    exit();
}
?>

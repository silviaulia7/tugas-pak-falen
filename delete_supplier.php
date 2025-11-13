<?php
session_start();
include "conn.php";

// 🔒 Cek login & role
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit();
}
if ($_SESSION['role'] !== 'admin') {
    echo "<script>
        alert('Akses ditolak! Hanya admin yang dapat menghapus supplier.');
        window.location='master_supplier.php';
    </script>";
    exit();
}

// Cek parameter
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>
        alert('Parameter ID tidak ditemukan!');
        window.location='master_supplier.php';
    </script>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Hapus data
$deleteQuery = "DELETE FROM supplier WHERE Supplier_ID='$id'";
if (mysqli_query($conn, $deleteQuery)) {
    echo "<script>
        alert('Supplier berhasil dihapus!');
        window.location='master_supplier.php';
    </script>";
    exit();
} else {
    echo "<script>
        alert('Gagal menghapus data: " . mysqli_error($conn) . "');
        window.location='master_supplier.php';
    </script>";
    exit();
}
?>

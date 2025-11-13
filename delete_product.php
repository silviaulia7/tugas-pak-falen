<?php
session_start();
include "conn.php";

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang dapat menghapus produk.'); window.location='master_product.php';</script>";
    exit();
}

if (!isset($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan!'); window.location='master_product.php';</script>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

$query = "DELETE FROM product WHERE Product_ID = '$id'";

if (mysqli_query($conn, $query)) {
    echo "<script>alert('Produk berhasil dihapus!'); window.location='master_product.php';</script>";
} else {
    echo "<script>alert('Gagal menghapus produk: " . mysqli_error($conn) . "'); window.location='master_product.php';</script>";
}
?>

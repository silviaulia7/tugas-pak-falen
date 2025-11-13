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
        alert('Akses ditolak! Hanya admin yang dapat mengedit supplier.');
        window.location='master_supplier.php';
    </script>";
    exit();
}

// Ambil data supplier berdasarkan ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID Supplier tidak ditemukan!'); window.location='master_supplier.php';</script>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM supplier WHERE Supplier_ID='$id'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    echo "<script>alert('Data supplier tidak ditemukan!'); window.location='master_supplier.php';</script>";
    exit();
}

// Update data jika disubmit
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Supplier_Name']);
    $contact = mysqli_real_escape_string($conn, $_POST['Contact']);

    $updateQuery = "UPDATE supplier SET 
                    Supplier_Name='$name',
                    Contact='$contact'
                    WHERE Supplier_ID='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Data supplier berhasil diperbarui!'); window.location='master_supplier.php';</script>";
        exit();
    } else {
        echo "<script>alert('Gagal memperbarui data: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div style="width:400px; margin:50px auto; padding:20px; border:1px solid #ccc; border-radius:10px;">
    <h2 style="text-align:center; color:#007bff;">Edit Supplier</h2>
    <form method="post">
        <label>Supplier Name</label><br>
        <input type="text" name="Supplier_Name" value="<?= $data['Supplier_Name']; ?>" required style="width:100%; padding:8px;"><br><br>

        <label>Contact</label><br>
        <input type="text" name="Contact" value="<?= $data['Contact']; ?>" required style="width:100%; padding:8px;"><br><br>

        <button type="submit" name="update" 
                style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">
            Update
        </button>
        <br><br>
        <a href="master_supplier.php" style="text-decoration:none; color:#007bff;">← Kembali</a>
    </form>
</div>

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
        alert('Akses ditolak! Hanya admin yang dapat menambah supplier.');
        window.location='master_supplier.php';
    </script>";
    exit();
}

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Supplier_Name']);
    $contact = mysqli_real_escape_string($conn, $_POST['Contact']);

    $query = "INSERT INTO supplier (Supplier_Name, Contact) VALUES ('$name', '$contact')";
    if (mysqli_query($conn, $query)) {
        echo "<script>
            alert('Supplier berhasil ditambahkan!');
            window.location='master_supplier.php';
        </script>";
        exit();
    } else {
        echo "<script>alert('Gagal menambahkan supplier: " . mysqli_error($conn) . "');</script>";
    }
}
?>

<div style="width:400px; margin:50px auto; padding:20px; border:1px solid #ccc; border-radius:10px;">
    <h2 style="text-align:center; color:#007bff;">Tambah Supplier</h2>
    <form method="post">
        <label>Supplier Name</label><br>
        <input type="text" name="Supplier_Name" required style="width:100%; padding:8px;"><br><br>

        <label>Contact</label><br>
        <input type="text" name="Contact" required style="width:100%; padding:8px;"><br><br>

        <button type="submit" name="save" 
                style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">
            Simpan
        </button>
        <br><br>
        <a href="master_supplier.php" style="text-decoration:none; color:#007bff;">← Kembali</a>
    </form>
</div>

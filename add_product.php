<?php
session_start();
include "conn.php";

// Hanya admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang dapat menambah produk.'); window.location='master_product.php';</script>";
    exit();
}

// Simpan data saat disubmit
if (isset($_POST['save'])) {
    $id = mysqli_real_escape_string($conn, $_POST['Product_ID']);
    $name = mysqli_real_escape_string($conn, $_POST['Product_Name']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $stock = mysqli_real_escape_string($conn, $_POST['Stock']);
    $supplier = mysqli_real_escape_string($conn, $_POST['Supplier_ID']);

    $query = "INSERT INTO product (Product_ID, Product_Name, Price, Stock, Supplier_ID)
              VALUES ('$id', '$name', '$price', '$stock', '$supplier')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location='master_product.php';</script>";
    } else {
        echo "<p style='color:red;'>Gagal menambahkan produk: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2 style="text-align:center;">Tambah Produk</h2>
<form method="post" style="width:400px; margin:auto; border:1px solid #ccc; padding:20px; border-radius:10px;">
    <label>Product ID</label><br>
    <input type="text" name="Product_ID" required style="width:100%; padding:8px;"><br><br>

    <label>Product Name</label><br>
    <input type="text" name="Product_Name" required style="width:100%; padding:8px;"><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="Price" required style="width:100%; padding:8px;"><br><br>

    <label>Stock</label><br>
    <input type="number" name="Stock" required style="width:100%; padding:8px;"><br><br>

    <label>Supplier ID</label><br>
    <input type="text" name="Supplier_ID" required style="width:100%; padding:8px;"><br><br>

    <button type="submit" name="save" style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">Simpan</button>
</form>

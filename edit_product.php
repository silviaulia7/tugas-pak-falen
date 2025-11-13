<?php
session_start();
include "conn.php";

// Cek login dan role
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang dapat mengedit produk.'); window.location='master_product.php';</script>";
    exit();
}

// Ambil ID dari URL
if (!isset($_GET['id'])) {
    echo "<script>alert('ID produk tidak ditemukan!'); window.location='master_product.php';</script>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data produk dari database
$query = "SELECT * FROM product WHERE Product_ID = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) == 0) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location='master_product.php';</script>";
    exit();
}

$row = mysqli_fetch_assoc($result);

// Update data saat form disubmit
if (isset($_POST['update'])) {
    $name = mysqli_real_escape_string($conn, $_POST['Product_Name']);
    $price = mysqli_real_escape_string($conn, $_POST['Price']);
    $stock = mysqli_real_escape_string($conn, $_POST['Stock']);
    $supplier = mysqli_real_escape_string($conn, $_POST['Supplier_ID']);

    $update = "UPDATE product 
               SET Product_Name='$name', Price='$price', Stock='$stock', Supplier_ID='$supplier' 
               WHERE Product_ID='$id'";

    if (mysqli_query($conn, $update)) {
        echo "<script>alert('Data produk berhasil diperbarui!'); window.location='master_product.php';</script>";
    } else {
        echo "<p style='color:red;'>Gagal memperbarui data: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2 style="text-align:center;">Edit Produk</h2>
<form method="post" style="width:400px; margin:auto; border:1px solid #ccc; padding:20px; border-radius:10px;">
    <label>Product ID</label><br>
    <input type="text" name="Product_ID" value="<?php echo $row['Product_ID']; ?>" readonly style="width:100%; padding:8px; background:#eee;"><br><br>

    <label>Product Name</label><br>
    <input type="text" name="Product_Name" value="<?php echo $row['Product_Name']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Price</label><br>
    <input type="number" step="0.01" name="Price" value="<?php echo $row['Price']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Stock</label><br>
    <input type="number" name="Stock" value="<?php echo $row['Stock']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Supplier ID</label><br>
    <input type="text" name="Supplier_ID" value="<?php echo $row['Supplier_ID']; ?>" required style="width:100%; padding:8px;"><br><br>

    <button type="submit" name="update" style="width:100%; padding:10px; background:#28a745; color:white; border:none; border-radius:5px;">Update</button>
</form>

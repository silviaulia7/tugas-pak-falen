<?php
session_start();
include "conn.php";

// Hanya admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses ditolak! Hanya admin yang dapat menambah user.'); window.location='master_user.php';</script>";
    exit();
}

if (isset($_POST['save'])) {
    $id = mysqli_real_escape_string($conn, $_POST['Customer_ID']);
    $username = mysqli_real_escape_string($conn, $_POST['Username']);
    $email = mysqli_real_escape_string($conn, $_POST['Email']);
    $phone = mysqli_real_escape_string($conn, $_POST['Phone']);
    $password = password_hash($_POST['Password'], PASSWORD_DEFAULT);
    $role = mysqli_real_escape_string($conn, $_POST['Role']);

    $query = "INSERT INTO user (Customer_ID, Username, Email, Phone, Password, Role)
              VALUES ('$id', '$username', '$email', '$phone', '$password', '$role')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('User berhasil ditambahkan!'); window.location='master_user.php';</script>";
    } else {
        echo "<p style='color:red;'>Gagal menambahkan user: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2 style="text-align:center;">Tambah User</h2>
<form method="post" style="width:400px; margin:auto; border:1px solid #ccc; padding:20px; border-radius:10px;">
    <label>Customer ID</label><br>
    <input type="text" name="Customer_ID" required style="width:100%; padding:8px;"><br><br>

    <label>Username</label><br>
    <input type="text" name="Username" required style="width:100%; padding:8px;"><br><br>

    <label>Email</label><br>
    <input type="email" name="Email" required style="width:100%; padding:8px;"><br><br>

    <label>Phone</label><br>
    <input type="text" name="Phone" required style="width:100%; padding:8px;"><br><br>

    <label>Password</label><br>
    <input type="password" name="Password" required style="width:100%; padding:8px;"><br><br>

    <label>Role</label><br>
    <select name="Role" style="width:100%; padding:8px;">
        <option value="user">User</option>
        <option value="admin">Admin</option>
    </select><br><br>

    <button type="submit" name="save" style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">Simpan</button>
</form>

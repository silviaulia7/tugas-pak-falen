<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "conn.php";

// Cek login
if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit();
}

// Cek role (hanya admin yang boleh edit)
if ($_SESSION['role'] !== 'admin') {
    echo "<p style='color:red; text-align:center;'>Akses ditolak! Hanya admin yang bisa mengedit data user.</p>";
    exit();
}

// Cek apakah parameter id ada
if (!isset($_GET['id'])) {
    echo "<p style='color:red; text-align:center;'>Parameter ID tidak ditemukan.</p>";
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

// Ambil data user berdasarkan Customer_ID
$query = "SELECT * FROM user WHERE Customer_ID = '$id'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 0) {
    echo "<p style='color:red; text-align:center;'>User dengan ID $id tidak ditemukan.</p>";
    exit();
}

$user = mysqli_fetch_assoc($result);

// Update data saat tombol disubmit
if (isset($_POST['update'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);

    $updateQuery = "UPDATE user 
                    SET Username='$username', Email='$email', Phone='$phone', Role='$role' 
                    WHERE Customer_ID='$id'";

    if (mysqli_query($conn, $updateQuery)) {
        echo "<script>alert('Data user berhasil diperbarui!'); window.location='user.php';</script>";
        exit();
    } else {
        echo "<p style='color:red;'>Gagal memperbarui data: " . mysqli_error($conn) . "</p>";
    }
}
?>

<h2 style="text-align:center;">Edit Data User</h2>

<form method="post" style="width:400px; margin:auto; border:1px solid #ccc; padding:20px; border-radius:10px;">
    <label>Customer ID</label><br>
    <input type="text" name="id" value="<?php echo $user['Customer_ID']; ?>" readonly style="width:100%; padding:8px;"><br><br>

    <label>Username</label><br>
    <input type="text" name="username" value="<?php echo $user['Username']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Email</label><br>
    <input type="email" name="email" value="<?php echo $user['Email']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Phone</label><br>
    <input type="text" name="phone" value="<?php echo $user['Phone']; ?>" required style="width:100%; padding:8px;"><br><br>

    <label>Role</label><br>
    <select name="role" style="width:100%; padding:8px;">
        <option value="admin" <?php if ($user['Role'] === 'admin') echo 'selected'; ?>>Admin</option>
        <option value="user" <?php if ($user['Role'] === 'user') echo 'selected'; ?>>User</option>
    </select><br><br>

    <button type="submit" name="update" style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">
        Update
    </button>
</form>

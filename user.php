<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "conn.php";

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit();
}

$role = $_SESSION['role'] ?? 'user';
?>

<?php include "header.php"; ?>

<div style="padding:20px;">
    <h2 style="text-align:center;">Master User</h2>

    <?php if ($role === 'admin'): ?>
        <div style="text-align:right; margin-bottom:10px;">
            <a href="add_user.php" style="background:#007bff; color:white; padding:8px 15px; text-decoration:none; border-radius:5px;">
                + Tambah User
            </a>
        </div>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th>Customer ID</th>
                <th>Username</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Role</th>
                <?php if ($role === 'admin'): ?>
                    <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM user ORDER BY Customer_ID ASC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?php echo $row['Customer_ID']; ?></td>
                <td><?php echo $row['Username']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['Phone']; ?></td>
                <td><?php echo $row['Role']; ?></td>
                <?php if ($role === 'admin'): ?>
                <td>
                    <a href="edit_user.php?id=<?php echo $row['Customer_ID']; ?>" style="color:green; margin-right:10px;">Edit</a>
                    <a href="delete_user.php?id=<?php echo $row['Customer_ID']; ?>" style="color:red;" onclick="return confirm('Yakin ingin menghapus user ini?')">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php
            endwhile;
        else:
            echo "<tr><td colspan='6'>Tidak ada data user.</td></tr>";
        endif;
        ?>
        </tbody>
    </table>
</div>

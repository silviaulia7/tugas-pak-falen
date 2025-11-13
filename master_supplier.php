<?php
session_start();
include "conn.php";

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit();
}

$isAdmin = (isset($_SESSION['role']) && $_SESSION['role'] === 'admin');

$query = "SELECT * FROM supplier ORDER BY Supplier_ID ASC";
$result = mysqli_query($conn, $query);

include "header.php";
?>

<div style="padding:20px;">
    <h2 style="text-align:center; margin-bottom:20px;">Master Supplier</h2>

    <div style="width:80%; margin:0 auto; display:flex; justify-content:space-between; align-items:center;">
        <div></div>
        <?php if ($isAdmin): ?>
            <a href="add_supplier.php" 
               style="padding:10px 20px; background:#007bff; color:white; border-radius:5px; text-decoration:none; font-weight:bold;">
               ➕ Tambah Supplier
            </a>
        <?php endif; ?>
    </div>

    <table border="1" cellspacing="0" cellpadding="8" style="width:80%; margin:20px auto; border-collapse:collapse;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th>Supplier ID</th>
                <th>Supplier Name</th>
                <th>Contact</th>
                <?php if ($isAdmin): ?>
                <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr style="text-align:center;">
                <td><?= $row['Supplier_ID']; ?></td>
                <td><?= $row['Supplier_Name']; ?></td>
                <td><?= $row['Contact']; ?></td>

                <?php if ($isAdmin): ?>
                <td>
                    <a href="edit_supplier.php?id=<?= $row['Supplier_ID']; ?>" 
                       style="color:#007bff; text-decoration:none; font-weight:bold;">Edit</a> |
                    <a href="delete_supplier.php?id=<?= $row['Supplier_ID']; ?>" 
                       style="color:red; text-decoration:none; font-weight:bold;"
                       onclick="return confirm('Yakin ingin menghapus supplier ini?');">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php
            endwhile;
        else:
            echo "<tr><td colspan='4' style='text-align:center;'>Tidak ada data supplier</td></tr>";
        endif;
        ?>
        </tbody>
    </table>
</div>

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
    <h2 style="text-align:center;">Master Product</h2>

    <?php if ($role === 'admin'): ?>
        <div style="text-align:right; margin-bottom:10px;">
            <a href="add_product.php" style="background:#007bff; color:white; padding:8px 15px; text-decoration:none; border-radius:5px;">
                + Tambah Product
            </a>
        </div>
    <?php endif; ?>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse:collapse; text-align:center;">
        <thead style="background:#007bff; color:white;">
            <tr>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Supplier ID</th>
                <?php if ($role === 'admin'): ?>
                    <th>Action</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
        <?php
        $query = "SELECT * FROM product ORDER BY Product_ID ASC";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0):
            while ($row = mysqli_fetch_assoc($result)):
        ?>
            <tr>
                <td><?php echo $row['Product_ID']; ?></td>
                <td><?php echo $row['Product_Name']; ?></td>
                <td><?php echo number_format($row['Price'], 2); ?></td>
                <td><?php echo $row['Stock']; ?></td>
                <td><?php echo $row['Supplier_ID']; ?></td>
                <?php if ($role === 'admin'): ?>
                <td>
                    <a href="edit_product.php?id=<?php echo $row['Product_ID']; ?>" style="color:green; margin-right:10px;">Edit</a>
                    <a href="delete_product.php?id=<?php echo $row['Product_ID']; ?>" style="color:red;" onclick="return confirm('Yakin ingin menghapus produk ini?')">Delete</a>
                </td>
                <?php endif; ?>
            </tr>
        <?php
            endwhile;
        else:
            echo "<tr><td colspan='6'>Tidak ada data produk.</td></tr>";
        endif;
        ?>
        </tbody>
    </table>
</div>

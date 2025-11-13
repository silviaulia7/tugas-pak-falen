<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['username'])) {
    header("Location: index.php?page=login");
    exit;
}

include "header.php";
?>

<div style="
    padding:40px;
    text-align:center; /* ini bikin teksnya di tengah */
    font-family: Arial, sans-serif;
">
    <h2 style="font-size:24px; color:#333;">
        Selamat datang, <?php echo htmlspecialchars($_SESSION['username']); ?> 
    </h2>
</div>

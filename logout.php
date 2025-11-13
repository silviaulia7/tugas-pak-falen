<?php
session_start();

if (isset($_POST['confirm_logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php?page=login");
    exit();
} elseif (isset($_POST['cancel_logout'])) {
    header("Location: index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Konfirmasi Logout</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .confirm-box {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.2);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
            color: #333;
        }
        form {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        button {
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
        }
        .yes {
            background-color: #dc3545;
            color: white;
        }
        .yes:hover {
            background-color: #b52d3a;
        }
        .no {
            background-color: #6c757d;
            color: white;
        }
        .no:hover {
            background-color: #565e64;
        }
    </style>
</head>
<body>

<div class="confirm-box">
    <h2>Apakah kamu yakin ingin logout?</h2>
    <form method="POST">
        <button type="submit" name="confirm_logout" class="yes">Ya, Logout</button>
        <button type="submit" name="cancel_logout" class="no">Batal</button>
    </form>
</div>

</body>
</html>

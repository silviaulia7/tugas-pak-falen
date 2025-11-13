<<<<<<< HEAD
<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Data</title>
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background: #f5f6fa;
}
.navbar {
    background: #3366ff;
    color: white;
    padding: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.navbar a {
    color: white;
    text-decoration: none;
    margin: 0 10px;
}
.navbar .menu {
    display: flex;
    gap: 15px;
}
.content {
    padding: 40px;
}
</style>
</head>
<body>
<div class="navbar">
    <div class="menu">
        <a href="dashboard.php">Dashboard</a>
        <a href="data.php">Data</a>
    </div>
    <div class="logout">
        <a href="logout.php">Logout</a>
    </div>
</div>

<div class="content">
    <h1 align='center'>Hello, ini silvi</h1>
<div style="text-align: center;">
  <img src="/tugas-pak-falen-5/img/wpp.jpg" alt="Roblox" width="200" style="border-radius: 10px;">
</div>
</div>
</body>
</html>
=======
<h1 align='center'>Hello, ini silvi</h1>
<div style="text-align: center;">
  <img src="/tugas-pak-falen-5/img/wpp.jpg" alt="Roblox" width="200" style="border-radius: 10px;">
</div>
>>>>>>> b7d8a5852065d456cb2dca89f61591aa12a451de

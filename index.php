<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple PHP Auth System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>User Authentication System</h1>
    <nav>
        <a href="index.php">Home</a> |
        <a href="index.php?page=login">Login</a> |
        <a href="index.php?page=register">Register</a> |
        <a href="index.php?page=data">Data</a>
    </nav>
    <hr>

    <?php
    if (isset($_GET['page'])) {
        $page = $_GET['page'];

        if ($page == "login") {
            include "login.php";
        } elseif ($page == "register") {
            include "register.php";
        } elseif ($page == "data") {   
            include "data.php";
        } else {
            echo "<h2>404 - Page not found!</h2>";
        }
    } else {
        echo "<h2>Welcome 👋</h2><p>Please select Login or Register from the menu above.</p>";
    }
    ?>
</body>
</html>

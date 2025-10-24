<?php
include 'conn.php';

$message = ''; 

if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $email    = $_POST['email'];
    $password = $_POST['password'];

    
    $check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $message = "<span style='color: red;'>Email sudah terdaftar!</span>";
    } else {
        $password_hash = password_hash($password, PASSWORD_DEFAULT);
        $query = "INSERT INTO users (username, email, password) 
                  VALUES ('$username', '$email', '$password_hash')";

        if (mysqli_query($conn, $query)) {
            $message = "<span style='color: green;'>Registrasi berhasil! Silakan login.</span>";
        } else {
            $message = "<span style='color: red;'>Gagal registrasi: " . mysqli_error($conn) . "</span>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 60px auto;
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
            font-size: 24px;
        }
        .message {
            text-align: center;
            margin-bottom: 20px;
            font-size: 16px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }
        input[type=text],
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 16px;
        }
        input[type=submit] {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            border: none;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }
        input[type=submit]:hover {
            background-color: #0056b3;
        }
        p {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
            color: #555;
        }
        a {
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Register</h2>

    
    <?php if ($message != ''): ?>
        <div class="message"><?= $message ?></div>
    <?php endif; ?>

    <form method="POST">
        <label>Username</label>
        <input type="text" name="username" placeholder="Masukkan Username" required>

        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan Email" required>

        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan Password" required>

        <input type="submit" name="register" value="Register">
    </form>

    <p>Sudah punya akun? 
        <a href="index.php?page=login">Login di sini</a>
    </p>
</div>

</body>
</html>

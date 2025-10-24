<?php
include 'conn.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$error_message = '';

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $result = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['email']    = $row['email'];

            $error_message = '<span style="color: green;">Login berhasil! Mengalihkan...</span>';
            echo "<script>
                    setTimeout(function(){
                        window.location='index.php';
                    }, 2000);
                  </script>";
        } else {
            $error_message = '<span style="color: red;">Password salah!</span>';
        }
    } else {
        $error_message = '<span style="color: red;">Email tidak ditemukan!</span>';
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 60%;
            margin: 80px auto;
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
        input[type=email],
        input[type=password] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 25px;
            font-size: 16px;
        }
        button {
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
        button:hover {
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
    <h2>Login</h2>


    <?php if ($error_message != ''): ?>
        <div class="message"><?= $error_message ?></div>
    <?php endif; ?>

    <form action="" method="POST">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" placeholder="Masukkan Email" required>

        <label for="password">Password</label>
        <input type="password" id="password" name="password" placeholder="Masukkan Password" required>

        <button type="submit" name="login">Login</button>
    </form>

    <p>Belum punya akun? 
        <a href="index.php?page=register">Register di sini</a>
    </p>
</div>

</body>
</html>

<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include "conn.php";

if (isset($_POST['register'])) {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    if ($password !== $confirm) {
        $error = "Password confirmation does not match.";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM user WHERE username='$username' OR email='$email'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username or Email is already registered.";
        } else {
            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $insert = mysqli_query($conn, "INSERT INTO user (username, email, phone, password)
                                           VALUES ('$username', '$email', '$phone', '$hashed')");

            if ($insert) {
                echo "<p style='color:green; font-weight:bold;'>Registration successful. You may now log in.</p>";
                echo "<meta http-equiv='refresh' content='2;url=index.php?page=login'>";
                exit(); // stop script supaya form tidak tampil lagi
            } else {
                $error = "Registration failed: " . mysqli_error($conn);
            }
        }
    }
}
?>

<h2>Register</h2>

<?php if (!empty($error)): ?>
<p style="color:red;"><?= $error ?></p>
<?php endif; ?>

<form method="post" action="">
    <label>Username</label>
    <input type="text" name="username" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Phone</label>
    <input type="text" name="phone" required>

    <label>Password</label>
    <input type="password" name="password" required>

    <label>Confirm Password</label>
    <input type="password" name="confirm_password" required>

    <button type="submit" name="register">Register</button>
</form>

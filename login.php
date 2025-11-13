<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include "conn.php";

if (isset($_POST['login'])) {
    $login = mysqli_real_escape_string($conn, $_POST['login_id']);
    $password = $_POST['password'];

    $query = "SELECT * FROM user 
              WHERE Username='$login' 
              OR Email='$login' 
              OR Phone='$login' 
              OR Customer_ID='$login'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['Password'])) {
            $_SESSION['user_id'] = $row['Customer_ID'];
            $_SESSION['username'] = $row['Username'];
            $_SESSION['role'] = $row['Role']; 

            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Password salah!";
        }
    } else {
        $error = "Akun tidak ditemukan!";
    }
}
?>

<h2 style="text-align:center;">Login</h2>
<?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

<form method="post" action="";>
    <label>Username / Email / Phone / ID</label>
    <input type="text" name="login_id" required style="width:100%; padding:8px;">

    <label>Password</label>
    <input type="password" name="password" required style="width:100%; padding:8px;">

    <button type="submit" name="login" style="width:100%; padding:10px; background:#007bff; color:white; border:none; border-radius:5px;">
        Login
    </button>
</form>

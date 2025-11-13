<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Lupa Password</title>
<style>
body {
    font-family: Arial, sans-serif;
    background: #f7f7f7;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}
.container {
    background: white;
    padding: 40px;
    width: 380px;
    border-radius: 12px;
    box-shadow: 0 0 10px rgba(0,0,0,0.1);
    text-align: center;
}
input {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.btn {
    background: #a0006b;
    color: white;
    padding: 10px;
    width: 100%;
    border: none;
    border-radius: 6px;
    font-weight: bold;
    cursor: pointer;
}
.btn:hover {
    background: #7a004f;
}
</style>
</head>
<body>
<div class="container">
    <h2>Lupa Password</h2>
    <p>Masukkan email Anda untuk reset password</p>
    <form method="POST" action="">
        <input type="email" name="email" placeholder="Masukkan Email Anda" required>
        <button type="submit" class="btn">Kirim Permintaan Reset</button>
    </form>
</div>
</body>
</html>

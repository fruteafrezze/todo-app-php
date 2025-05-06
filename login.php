<?php
session_start();
include 'database.php';
$pesan = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $conn = koneksiDB();

    $stmt = $conn->prepare("SELECT * FROM user_data WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        $hash = $user['password'];
    
        // Cek apakah password di DB udah di-hash
        if (strlen($hash) > 20 && password_verify($password, $hash)) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Pindahin header ke sini
            exit();  // Pastikan langsung keluar setelah pengalihan
        } elseif ($password === $hash) {
            // fallback buat user yang masih plain text (tidak disarankan jangka panjang)
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header("Location: index.php"); // Pindahin header ke sini
            exit();  // Pastikan langsung keluar setelah pengalihan
        } else {
            $pesan = "❌ Password salah!";
        }
    }
}    
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Form Login</h2>

    <?php if ($pesan != "") echo "<p style='color:red;'>$pesan</p>"; ?>

    <form method="POST" action="login.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Login</button>
    </form>

    <p>Belum punya akun? <a href="register.php">Daftar di sini</a></p>
</body>
</html>
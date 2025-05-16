<?php
include 'database.php';
$pesan ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $conn = koneksiDB();

    $cek = $conn->prepare("SELECT * FROM user_data WHERE username = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $result = $cek->get_result();

    if ($result->num_rows > 0) {
        echo "Username sudah dipakai, bro!";
    } else {
        $stmt = $conn->prepare("INSERT INTO user_data (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password); 

        if ($stmt->execute()) {            
            header("Location: index.php");
            exit();
        } else {
            echo "Gagal daftar: " . $stmt->error;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Form Register</h2>
    <div class="container">
    <?php if ($pesan != "") echo "<p style='color:red;'>$pesan</p>"; ?>

    <form method="POST" action="register.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <button type="submit">Register</button>
    </form>

    <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </div>
</body>
</html>
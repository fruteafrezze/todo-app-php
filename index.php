<?php
include 'auth.php';       // Buat pastiin user udah login
include 'database.php';   // Koneksi database

$conn = koneksiDB();

// Ambil data activity dari database
$result = mysqli_query($conn, "SELECT * FROM activity_list ORDER BY id DESC");
echo "Selamat datang, " . $_SESSION['username'];

?>

<!DOCTYPE html>
<html>
    <head>
        <title>To-Do List</title>
        <link rel="stylesheet" href="styles.css">
    </head>
    <body>
        <h2>To-Do List</h2>
        <div class="container">
            <form action="add.php" method="POST">
                <input type="text" name="title" placeholder="Apa yang mau kamu kerjain?" required style="width: 15%; height: 20px;">
                <button type="submit">Tambah</button>
            </form>

            <table border="1" cellspacing="0" cellpadding="10" style="margin: auto;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($result)): ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= htmlspecialchars($row['title']) ?></td>
                            <td><?= $row['is_done'] ? '✅ Selesai' : '❌ Belum' ?></td>
                            <td>
                                <a href="complete.php?id=<?= $row['id'] ?>">Selesai</a> |
                                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin mau hapus?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    <p><a href="logout.php">Logout</a></p>

    </body>
</html>

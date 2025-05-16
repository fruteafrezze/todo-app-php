<?php
include 'auth.php';       
include 'database.php';   

$conn = koneksiDB();

$result = mysqli_query($conn, "SELECT * FROM activity_list ORDER BY id DESC");
echo "Selamat datang, " . $_SESSION['username'];

$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$result = mysqli_query($conn, "SELECT * FROM activity_list ORDER BY id DESC LIMIT $limit OFFSET $offset");

$total_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM activity_list");
$total_row = mysqli_fetch_assoc($total_result);
$total_data = $total_row['total'];
$total_page = ceil($total_data / $limit);
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
                <input type="text" name="title" placeholder="Apa yang mau kamu kerjain?" required style="width: 30%; height: 20px;">
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
    <div>
        <?php for ($i = 1; $i <= $total_page; $i++): ?>
            <a href="?page=<?= $i ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
    </body>
</html>

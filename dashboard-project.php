
<?php
require_once __DIR__ . '/config/database.php';

$stmt = $pdo->query("SELECT * FROM projects ORDER BY dibuat_pada DESC");
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Project</title>
</head>
<body>

    <h1>Dashboard Project</h1>

    <a href="tambah-project.php">Tambah Project</a>

    <br><br>

    <table border="1" cellpadding="10">
        <tr>
            <th>Judul</th>
            <th>Teknologi</th>
            <th>Tanggal Dibuat</th>
            <th>Aksi</th>
        </tr>

        <?php foreach ($projects as $project): ?>
        <tr>
            <td><?= htmlspecialchars($project['judul']) ?></td>
            <td><?= htmlspecialchars($project['teknologi']) ?></td>
            <td><?= htmlspecialchars($project['dibuat_pada']) ?></td>

            <td>
                <form action="hapus-project.php" method="post"
                    onsubmit="return confirm('Yakin ingin menghapus project ini?')">

                    <input type="hidden" name="id"
                        value="<?= $project['id'] ?>">

                    <button type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>

</body>
</html>

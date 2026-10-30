
<?php
require_once __DIR__ . '/config/database.php';

// Memastikan ID tersedia
if (!isset($_GET['id']) || !ctype_digit($_GET['id'])) {
    header('Location: dashboard-project.php');
    exit;
}

// Mengambil data project berdasarkan ID
$stmt = $pdo->prepare('SELECT * FROM projects WHERE id = :id');

$stmt->execute([
    'id' => $_GET['id']
]);

$project = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika project tidak ditemukan
if (!$project) {
    header('Location: dashboard-project.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Project</title>
</head>
<body>

    <h1>Edit Project</h1>

    <form method="post" action="update-project.php">

        <input type="hidden" name="id"
               value="<?= $project['id'] ?>">

        <p>
            <label>Judul Project</label><br>
            <input type="text" name="judul"
                   value="<?= htmlspecialchars($project['judul']) ?>">
        </p>

        <p>
            <label>Teknologi</label><br>
            <input type="text" name="teknologi"
                   value="<?= htmlspecialchars($project['teknologi']) ?>">
        </p>

        <button type="submit">Simpan Perubahan</button>

        <a href="dashboard-project.php">Batal</a>

    </form>

</body>
</html>

```php
<?php
session_start();

require_once __DIR__ . '/config/database.php';

// Mengecek apakah tombol submit ditekan
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Mengambil data dari form
    $judul = trim($_POST['judul'] ?? '');
    $deskripsi = trim($_POST['deskripsi'] ?? '');
    $teknologi = trim($_POST['teknologi'] ?? '');
    $tautan = trim($_POST['tautan'] ?? '');
    $dibuatPada = trim($_POST['dibuat_pada'] ?? '');

    // Validasi: mengecek apakah ada kolom kosong
    if (
        $judul === '' ||
        $deskripsi === '' ||
        $teknologi === '' ||
        $tautan === '' ||
        $dibuatPada === ''
    ) {
        $_SESSION['error'] = 'Semua field wajib diisi.';
        header('Location: tambah-project.php');
        exit();
    }

    // Menyimpan data ke database
    $stmt = $pdo->prepare(
        'INSERT INTO projects (
            judul,
            deskripsi,
            teknologi,
            tautan,
            dibuat_pada
        ) VALUES (
            :judul,
            :deskripsi,
            :teknologi,
            :tautan,
            :dibuat_pada
        )'
    );

    $stmt->execute([
        'judul' => $judul,
        'deskripsi' => $deskripsi,
        'teknologi' => $teknologi,
        'tautan' => $tautan,
        'dibuat_pada' => $dibuatPada,
    ]);

    // Jika berhasil, kembali ke dashboard project
    header('Location: dashboard-project.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Project Baru</title>
</head>
<body>

    <h1>Tambah Project Baru</h1>

    <form method="post">

        <label>Judul Project</label><br>
        <input type="text" name="judul"><br><br>

        <label>Deskripsi</label><br>
        <textarea name="deskripsi" rows="4"></textarea><br><br>

        <label>Teknologi</label><br>
        <input
            type="text"
            name="teknologi"
            placeholder="Contoh: PHP, MySQL"
        ><br><br>

        <label>Tautan (Link)</label><br>
        <input
            type="url"
            name="tautan"
            placeholder="https://..."
        ><br><br>

        <label>Tanggal Dibuat</label><br>
        <input type="date" name="dibuat_pada"><br><br>

        <?php if (isset($_SESSION['error'])): ?>

            <p style="color: red;">
                <?php
                echo htmlspecialchars($_SESSION['error']);
                unset($_SESSION['error']);
                ?>
            </p>

        <?php endif; ?>

        <button type="submit">Simpan Project</button>

    </form>

</body>
</html>
```
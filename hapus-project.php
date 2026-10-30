
<?php

require_once __DIR__ . '/config/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {

    $id = $_POST['id'];

    if (filter_var($id, FILTER_VALIDATE_INT) !== false && $id > 0) {

        $stmt = $pdo->prepare("DELETE FROM projects WHERE id = ?");

        $stmt->execute([$id]);

    }
}

header('Location: dashboard-project.php');
exit;

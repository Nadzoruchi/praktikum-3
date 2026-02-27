<?php
require 'connection.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM tugas WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mata_kuliah = $_POST['mata_kuliah'];
    $judul_tugas = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $sql = "UPDATE tugas 
            SET mata_kuliah=?, judul_tugas=?, deskripsi=?, deadline=?, status=? 
            WHERE id=?";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$mata_kuliah, $judul_tugas, $deskripsi, $deadline, $status, $id])) {
        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Edit Tugas</h2>

<form method="POST">
    <input type="text" name="mata_kuliah" class="form-control mb-2" value="<?= $data['mata_kuliah']; ?>" required>
    <input type="text" name="judul_tugas" class="form-control mb-2" value="<?= $data['judul_tugas']; ?>" required>
    <textarea name="deskripsi" class="form-control mb-2"><?= $data['deskripsi']; ?></textarea>
    <input type="date" name="deadline" class="form-control mb-2" value="<?= $data['deadline']; ?>" required>
    
    <select name="status" class="form-control mb-3">
        <option value="Belum Selesai" <?= $data['status']=='Belum Selesai'?'selected':'' ?>>Belum Selesai</option>
        <option value="Selesai" <?= $data['status']=='Selesai'?'selected':'' ?>>Selesai</option>
    </select>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>
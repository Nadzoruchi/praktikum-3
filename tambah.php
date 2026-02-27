<?php
require 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $mata_kuliah = $_POST['mata_kuliah'];
    $judul_tugas = $_POST['judul_tugas'];
    $deskripsi = $_POST['deskripsi'];
    $deadline = $_POST['deadline'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tugas (mata_kuliah, judul_tugas, deskripsi, deadline, status) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    if ($stmt->execute([$mata_kuliah, $judul_tugas, $deskripsi, $deadline, $status])) {
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

<h2>Tambah Tugas</h2>

<form method="POST">
    <input type="text" name="mata_kuliah" class="form-control mb-2" placeholder="Mata Kuliah" required>
    <input type="text" name="judul_tugas" class="form-control mb-2" placeholder="Judul Tugas" required>
    <textarea name="deskripsi" class="form-control mb-2" placeholder="Deskripsi"></textarea>
    <input type="date" name="deadline" class="form-control mb-2" required>

    <select name="status" class="form-control mb-3">
        <option value="Belum Selesai">Belum Selesai</option>
        <option value="Selesai">Selesai</option>
    </select>

    <button type="submit" class="btn btn-success">Simpan</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
</form>

</body>
</html>
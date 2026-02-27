<?php
require 'connection.php';

$search = "";

if(isset($_GET['search']) && $_GET['search'] != ""){
    $search = $_GET['search'];
    $stmt = $pdo->prepare("SELECT * FROM tugas 
                           WHERE mata_kuliah LIKE :search 
                           OR judul_tugas LIKE :search 
                           ORDER BY deadline ASC");
    $stmt->execute(['search' => "%$search%"]);
} else {
    $stmt = $pdo->query("SELECT * FROM tugas ORDER BY deadline ASC");
}

$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html>
<head>
    <title>Manajemen Tugas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <h2 class="mb-4">📚 Manajemen Tugas Mahasiswa</h2>

    <a href="tambah.php" class="btn btn-primary mb-3">+ Tambah Tugas</a>

    <form method="GET" class="mb-3">
        <input type="text" name="search" class="form-control" placeholder="Cari tugas..." value="<?= $search ?>">
    </form>

    <table class="table table-bordered table-hover bg-white">
        <tr class="table-dark">
            <th>Mata Kuliah</th>
            <th>Judul</th>
            <th>Deadline</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        <?php foreach($data as $row): 
    $today = date("Y-m-d");
    $deadline_color = ($row['deadline'] < $today && $row['status'] == 'Belum Selesai') ? "text-danger fw-bold" : "";
?>
<tr>
    <td><?= $row['mata_kuliah'] ?></td>
    <td><?= $row['judul_tugas'] ?></td>
    <td class="<?= $deadline_color ?>"><?= $row['deadline'] ?></td>
    <td>
        <?php if($row['status'] == "Selesai"){ ?>
            <span class="badge bg-success">Selesai</span>
        <?php } else { ?>
            <span class="badge bg-warning text-dark">Belum</span>
        <?php } ?>
    </td>
    <td>
        <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
        <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus?')">Hapus</a>
    </td>
</tr>
<?php endforeach; ?>
    </table>
</div>

</body>
</html>
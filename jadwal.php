<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    include "koneksi.php"; //Memanggil file dengan nama koneksi.php
    
    if(isset($_GET["delete"])){   //Untuk hapus file
        $id = $_GET["delete"];
        $sql = "DELETE FROM `jadwal_kelas` WHERE id_jadwal = $id"; //Ini Query Delete Tabel

        if(mysqli_query($conn, $sql)){
            $status = "File Berhasil Dihapus";
        } else {
            $status = "File Gagal Dihapus";
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Perkuliahan</title>
    <!-- Nambah Favicon web-->
    <link rel="shortcut icon" href="img/UNDIKSHA.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php"><img src="img/Header.png" alt="Logo Undiksha" width="150 px"></a>
        <ul class="navbar-nav">
        <li class="nav-item">
        <a class="nav-link" href="dosen.php">Dosen</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="kelas.php">Kelas</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="jadwal.php">Jadwal</a>
        </li>
        </ul>
    </nav>

    <?php if(isset($_GET['delete'])) : ?>
        <div class="alert alert-danger"> <?php echo $status; ?></div>
    <?php endif; ?>

    <div class="container p-3 my-3 bg-dark text-white text-center">
        <h1>Data Jadwal Perkuliahan</h1>
        <p>Berikut adalah data jadwal perkuliahan yang telah terdaftar pada sistem. Klik tambah untuk menambahkan data, edit untuk mengubah dan hapus untuk menghapus.</p>
    </div>

    <div class="container col-8">
            <?php
                include'koneksi.php';
                $sql = "SELECT * FROM `jadwal_kelas` INNER JOIN dosen ON dosen.id_dosen=jadwal_kelas.id_dosen INNER JOIN  kelas ON jadwal_kelas.id_kelas=kelas.id_kelas;";
                $result = mysqli_query($conn,$sql);
            ?>
        <div class="row justify-content-center">
        <table class="table table-striped table-hover">
            <thead>
                <tr class="table-secondary">
                    <th>Nama dosen</th>
                    <th>Kelas</th>
                    <th>Jadwal</th>
                    <th>Mata Kuliah</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["nama_dosen"];?></td>
                    <td><?php echo $row["nama_kelas"];?></td>
                    <td><?php echo $row["jadwal"];?></td>
                    <td><?php echo $row["matakuliah"];?></td>
                    <td>
                        <a href="formjadwal.php?edit=<?php echo $row["id_jadwal"];  ?>" class="btn btn-primary" >Edit</a>
                        <a href="jadwal.php?delete=<?php echo $row["id_jadwal"]; ?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
        </div>
    </div>
    <div class="button d-flex justify-content-center mb-5">
        <a href="formjadwal.php" class="btn btn-primary">Tambah Data</a>
    </div>  
</body>
</html>
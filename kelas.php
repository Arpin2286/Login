<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
    
    include 'koneksi.php'; // memanggil file koneksi.php sebagai penghubung php dengan MySQL

    if(isset($_GET["delete"])){ // Untuk Delete, ini dijalankan jika tombol dengan name Get dijalankan
        $id = $_GET["delete"];
        $sql = "DELETE FROM `kelas` WHERE id_kelas=$id"; //Ini Query untuk delete tabel

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
    <title>Sistem Informasi Dosen</title>
    
    <!--Logo Favicon-->
    <link rel="shortcut icon" href="img/UNDIKSHA.png"> 

    <!-- Import Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Logo untuk sistemnya -->
        <a class="navbar-brand" href="index.php"><img src="img/Header.png" alt="Logo Undiksha" width="150 px"></a>
        
        <!-- Menu di Nav Bar -->
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

    <!--Peringatan data dihapus-->
    <?php if(isset($_GET['delete'])) : ?>
        <div class="alert alert-danger"> <?php echo $status; ?></div>
    <?php endif; ?>

    <div class="container p-3 my-3 bg-dark text-white text-center">
        <h1>Data Kelas</h1>
        <p>Berikut adalah data kelas yang telah terdaftar pada sistem. Klik tambah untuk menambahkan data, edit untuk mengubah dan hapus untuk menghapus.</p>
    </div>

    <!-- Tampilkan Data di Database tabel kelas.. -->
    <div class="container col-8">
        <?php
            include'koneksi.php';
            $sql = "SELECT * FROM kelas";
            $result = mysqli_query($conn,$sql);
        ?>
        <div class="row justify-content-center">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>Nama Kelas</th>
                    <th>Prodi</th>
                    <th>Fakultas</th>
                    <th>Action</th>
                </tr>
            </thead>
                <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row["nama_kelas"]?></td>
                    <td><?php echo $row["prodi"]?></td>
                    <td><?php echo $row["fakultas"]?></td>
                    <td>
                        <a href="formkelas.php?edit=<?php echo $row["id_kelas"];?>" class="btn btn-primary" >Edit</a>
                        <a href="kelas.php?delete=<?php echo $row["id_kelas"];?>" class="btn btn-danger">Hapus</a>
                    </td>
                </tr>
            <?php endwhile;?>
        </table>
        </div>
    </div>
    <!--Tombol Tambah Data ke form penambahan Data-->
    <div class="button d-flex justify-content-center mb-5">
        <a href="formkelas.php" class="btn btn-primary">Tambah Data</a>
    </div>
</body>
</html>
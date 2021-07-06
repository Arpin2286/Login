<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    include 'koneksi.php'; //penghubung PHP ke Databases

    $update = false;
    $id = 0;
    $dosen = "";
    $kelas = "";
    $namamatkul = "";
    $tanggal = "";

    if(isset($_POST["submit"])){
        $dosen = $_POST["dosen"];
        $kelas = $_POST["kelas"];
        $namamatkul = $_POST["namamatkul"];
        $tanggal = $_POST["tanggal"];

        $sql = "INSERT INTO `jadwal_kelas` (`id_jadwal`, `id_dosen`, `id_kelas`, `jadwal`, `matakuliah`) VALUES (NULL, '$dosen', '$kelas', '$tanggal', '$namamatkul');";

        if(mysqli_query($conn, $sql)){
            $status = "File Berhasil Diunggah";
        } else {
            $status = "File Gagal Diunggah";
        }
    }

    if(isset($_GET["edit"])){
        $update = true;
        $id= $_GET["edit"];
        $sql= "SELECT * FROM `jadwal_kelas` WHERE id_jadwal = $id";
        $q1 = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($q1);

        $dosen = $row["id_dosen"];
        $kelas = $row["id_kelas"];
        $namamatkul = $row["matakuliah"];
        $tanggal = $row["jadwal"];

        if($dosen == " "){
            $status = "data kosong";
        }

    }

    if(isset($_POST["edit"])){
        $id = $_POST["id"];
        $dosen = $_POST["dosen"];
        $kelas = $_POST["kelas"];
        $namamatkul = $_POST["namamatkul"];
        $tanggal = $_POST["tanggal"];

        $sql = "UPDATE `jadwal_kelas` SET `id_dosen`='$dosen',`id_kelas`='$kelas',`jadwal`='$tanggal',`matakuliah`='$namamatkul' WHERE id_jadwal = '$id'";

        if(mysqli_query($conn, $sql)){
            $status = "File Berhasil Diunggah";
        } else {
            $status = "File Gagal Diunggah";
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
    <!-- Import Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <a class="navbar-brand" href="index.php"><img src="img/Header.png" alt="Logo Undiksha" width="150 px"></a>
        <!-- Links -->
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

    <!-- This Input Tabel Jadwal -->
    <div class="container">
        <div class="row justify-content-center">
        <div class="border border-secondary rounded mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <?php
                    include 'koneksi.php';
                    $sql= "SELECT * FROM dosen";
                    $result = mysqli_query($conn,$sql);
                ?>
                <label for="Dosen">Nama Dosen</label><br>
                <select name="dosen" id="dosen" class='form-control' required>
                <option value="">Pilih Nama Dosen</option>
                    <?php while($row = $result->fetch_assoc()):?>
                    <option value="<?php echo $row["id_dosen"];?>"><?php echo $row["nama_dosen"]; ?></option>
                    <?php endwhile; ?>
                </select><br>
                
                <?php 
                    include 'koneksi.php';
                    $sql= "SELECT * FROM `kelas`";
                    $result = mysqli_query($conn,$sql); 
                ?>
                <label for="kelas">Kelas</label> <br>
                <select name="kelas" id="kelas" class='form-control' required>
                <option value="">Pilih Nama Kelas</option>
                    <?php while($row = $result->fetch_assoc()) : ?>
                    <option value="<?php echo $row["id_kelas"]?>"><?php echo $row["nama_kelas"];?></option>
                    <?php endwhile; ?>
                </select><br>

                <label for="Nama Mata Kuliah">Mata Kuliah</label><br>
                <input type="text" name="namamatkul" class='form-control' placeholder="Masukkan Nama Matakuliah" id="namamatkul" required><br>
                

                <label for="tanggal">Tanggal</label><br>
                <input type="date" name="tanggal" class='form-control' required>
                <br>
                <div class="button d-flex justify-content-center mb-5">
                    <?php if($update == true):?>
                        <input type="submit" class="btn btn-warning btn-lg" name="edit" value="Ubah">
                        <?php else:?>
                        <input type="submit" class="btn btn-success btn-lg" name="submit" value="Simpan">
                    <?php endif; ?>
                </div> 
            </form>
        </div>
    </div>

</body>
</html>
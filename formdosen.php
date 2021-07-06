<?php

    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }

    include "koneksi.php";

    $update = false;
    $id = 0;
    $nama_foto= "";
    $nama = "";
    $nip= "";
    $prodi="";
    $fakultas="";

    if(isset($_POST["submit"])){
        $nama = $_POST["nama"];
        $nip = $_POST["nip"];
        $prodi = $_POST["prodi"];
        $fakultas = $_POST["fakultas"];

        if($_FILES["foto"]["error"] == 4){
            echo"Waduh Error Jik";
        }else{
            $nama_foto = $_FILES["foto"]["name"];
            $ambil = $_FILES["foto"]["tmp_name"] ;
            $tujuan = "img/".$nama_foto;
            $move = move_uploaded_file($ambil,$tujuan);
        }

        $sql = "INSERT INTO `dosen`(`foto_dosen`, `nip_dosen`, `nama_dosen`, `prodi`, `fakultas`) VALUES ('$nama_foto','$nip','$nama','$prodi','$fakultas')";

        if(mysqli_query($conn, $sql)){
            $status = "File Berhasil Diunggah";
        } else {
            $status = "File Gagal Diunggah";
        }
    }

    if(isset($_GET["edit"])){
        $update = true;
        $id= $_GET["edit"];
        $sql= "SELECT * FROM `dosen` WHERE id_dosen = $id";
        $q1 = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($q1);

        $nama = $row["nama_dosen"];
        $nip = $row["nip_dosen"];
        $prodi = $row["prodi"];
        $fakultas = $row["fakultas"];


        if($nip == " "){
            $status = "data kosong";
        }
    }

    if(isset($_POST["edit"])){
        $id = $_POST["id"];
        $nama = $_POST["nama"];
        $nip = $_POST["nip"];
        $prodi = $_POST["prodi"];
        $fakultas = $_POST["fakultas"];

        if($_FILES["foto"]["error"] == 4){
            echo"Waduh Error Jik";
        }else{
            $nama_foto = $_FILES["foto"]["name"];
            $ambil = $_FILES["foto"]["tmp_name"] ;
            $tujuan = "img/".$nama_foto;
            $move = move_uploaded_file($ambil,$tujuan);
        }

        $sql = "UPDATE `dosen` SET `foto_dosen`='$nama_foto',`nip_dosen`='$nip',`nama_dosen`='$nama',`prodi`='$prodi',`fakultas`='$fakultas' WHERE id_dosen = $id";

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
    <title>Formulir Dosen</title>

    <!--Logo Favicon-->
    <link rel="shortcut icon" href="img/UNDIKSHA.png">

    <!--Import Bootstrap 5-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Logo di Sistem -->
    <a class="navbar-brand" href="index.php"><img src="img/Header.png" alt="Logo Undiksha" width="150 px"></a>
    <!-- Menu di Navbar -->
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
    <!-- Form Input Tabel Dosen -->
    <div class="container">
        <div class="row justify-content-center">
        <div class="border border-secondary rounded mt-3">
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <label for="Nama Dosen">Nama Dosen</label><br>
                <input type="text" class="form-control" name="nama" placeholder="Nama Dosen" value="<?php echo $nama; ?>" id="nama" required><br>

                <label for="NIP">NIP Dosen</label><br>
                <input type="text" class="form-control" name="nip" placeholder="Nomor Induk Dosen" value="<?php echo $nip; ?>" id="NIP" required><br>

                <label for="FILE">Upload Foto</label><br>
                <input type="file" class="form-control" name="foto" value="<?php echo $nama_foto; ?>" id="foto" required><br>

                <div class="row">
                    <div class="col">
                        <label for="prodi">Program Studi</label><br>
                        <select name="prodi" class="form-control" id="prodi" required>
                            <option value="Sistem Informasi"<?php if($prodi == "Sistem informasi") echo "dipilih"?>>Sistem Informasi</option>
                            <option value="Pendidikan Teknik Informatika" <?php if($prodi == "Pendidikan Teknik Informatika") echo "dipilih"?>>Pendidikan Teknik Informatika</option>
                            <option value="Pendidikan Ekonomi" <?php if($prodi == "Pendidikan Ekonomi") echo "dipilih"?>>Pendidikan Ekonomi</option>
                            <option value="S1 Manajemen" <?php if($prodi == "S1 Manajemen") echo "dipilih"?>>S1 Manajemen</option>
                            <option value="Pendidikan Matematika" <?php if($prodi == "Pendidikan Matematika") echo "dipilih"?>>Pendidikan Matematika</option>
                            <option value="Pendidikan Olahraga" <?php if($prodi == "Pendidikan Olahraga") echo "dipilih"?>>Pendidikan Olahraga</option>
                            <option value="Kedokteran" <?php if($prodi == "Kedokteran") echo "dipilih"?>>Kedokteran</option>
                            <option value="Pendidikan Sekolah Dasar" <?php if($prodi == "Pendidikan Sekolah Dasar") echo "dipilih"?>>Pendidikan Sekolah Dasar</option>
                            <option value="Ilmu Hukum" <?php if($prodi == "Ilmu Hukum") echo "dipilih"?>>Ilmu Hukum</option>
                            <option value="Pendidikan Bahasa Inggris" <?php if($prodi == "Pendidikan Bahasa Inggris") echo "dipilih"?>>Pendidikan Bahasa Inggris</option>
                            <option value="Pendidikan Seni Rupa" <?php if($prodi == "Pendidikan Seni Rupa") echo "dipilih"?>>Pendidikan Seni Rupa</option>
                        </select><br>
                    </div>
                <div class="col">
                    <label for="fakultas">Fakultas</label><br>
                    <select name="fakultas" class="form-control" id="fakultas" required>
                        <option value="Fakultas Teknik dan Kejuruan" <?php if($fakultas == "Fakultas Teknik dan Kejuruan") echo "dipilih"?>>Fakultas Teknik dan Kejuruan</option>
                        <option value="Fakultas Kedokteran" <?php if($fakultas == "Fakultas Kedokteran") echo "dipilih"?>>Fakultas Kedokteran</option>
                        <option value="Fakultas Matematika dan IPA" <?php if($fakultas == "Fakultas Matematika dan IPA") echo "dipilih"?>>Fakultas Matematika dan IPA</option>
                        <option value="Fakultas Ilmu Pendidikan" <?php if($fakultas == "Fakultas Ilmu Pendidikan") echo "dipilih"?>>Fakultas Ilmu Pendidikan</option>
                        <option value="Fakultas Hukum dan Ilmu Sosial" <?php if($fakultas == "Fakultas Hukum dan Ilmu Sosial") echo "dipilih"?>>Fakultas Hukum dan Ilmu Sosial</option>
                        <option value="Fakultas Ekonomi" <?php if($fakultas == "Fakultas Ekonomi") echo "dipilih"?>>Fakultas Ekonomi</option>
                        <option value="Fakultas Bahasa dan Seni" <?php if($fakultas == "Fakultas Bahasa dan Seni") echo "dipilih"?>>Fakultas Bahasa dan Seni</option>
                        <option value="Fakultas Olahraga dan Kesehatan" <?php if($fakultas == "Fakultas Olahraga dan Kesehatan") echo "dipilih"?>>Fakultas Olahraga dan Kesehatan</option>
                    </select><br><br>
                </div>
                </div>
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

    <!-- This Output :D -->
    <?php if(isset($_POST["submit"])) : ?>
        <div class="alert alert-primary">
            <h2>Data Dosen</h2>
            <?php
                echo "Nama : $nama <br>";
                echo "NIP : $nip <br>";
                echo "Program Studi : $prodi <br>";
                echo "Fakultas : $fakultas <br>";
                echo "$status";
            ?>
        </div>
    <?php elseif (isset($_GET["delete"])) : ?>
        <div class="alert alert-danger">
            <?php echo "$status";?>
        </div>
    <?php endif;?>
</body>
</html>
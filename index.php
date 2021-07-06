<?php
    session_start();

    if(!isset($_SESSION["login"])){
        header("Location: login.php");
        exit;
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Informasi Dosen</title>
    <!--Favicon-->
    <link rel="shortcut icon" href="img/UNDIKSHA.png">
    <!-- Import Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <div class="header">
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
        <!-- Logo Sistem -->
        <a class="navbar-brand" href="index.php"><img src="img/Header.png" alt="Logo Undiksha" width="150 px"></a>
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="logout.php">Keluar</a>
            </li>
        </ul>
    </nav>
    </div>

        <div class="container alert alert-info justify-content-center">
            <h1 class="display-4">Selamat Datang</h1>
            <p class="lead">Silahkan pilih menu dibawah ini untuk memilih data yang ingin anda kelola</p>
        </div>
    <br>

    <!--This Menu In System-->
    <div class="container justify-content-center">
        <div class="row">
            <div class="col text-center">
            <a class="btn" href="dosen.php"><div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://image.flaticon.com/icons/png/512/2883/2883841.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Data Dosen</h5>
                </div>
                </div></a>
            </div>
            <div class="col text-center">
            <a class="btn" href="kelas.php"><div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://image.flaticon.com/icons/png/512/943/943069.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Data Kelas</h5>
                </div>
                </div></a>
            </div>
            <div class="col text-center">
            <a class="btn" href="jadwal.php"><div class="card" style="width: 18rem;">
                <img class="card-img-top" src="https://image.flaticon.com/icons/png/512/3652/3652191.png" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Data Jadwal</h5>
                </div>
                </div></a>
            </div>
        </div>   
    </div>

</body>
</html>
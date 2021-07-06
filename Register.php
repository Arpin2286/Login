<?php
    include 'koneksi.php';

    if(isset($_POST["register"])){
        if(register($_POST)>0){
            echo"<script> 
            alert('Anda Berhasil Melakukan Pendaftaran'); 
            </script>";
            echo("Location: login.php");
        }else{
            echo mysqli_error($conn);
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link rel="shortcut icon" href="img/UNDIKSHA.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container mt-5 p-3">
        <div class="row no-grutter">
                <div class="col-lg-5">
                    <img src="img/register.png" alt="Test" class="img-fluid mt-5">
                </div>
                <div class="col-lg-5 ps-5 pt-3">
                    <div class="header">
                        <h1 class="font-weight-bold py-5 d-flex justify-content-center">SignUp</h1>
                    </div>
                    <?php if(isset($error)) : ?>
                        <div class="alert alert-danger">
                            <p>Username atau Password Salah</p>
                        </div>
                    <?php endif; ?>
                    <div class="form mb-5">
                        <form action="" method="post">
                            <Label>Username :</Label><br>
                            <input type="text" class="form-control" placeholder="Username" name="username" id="username" required><br>

                            <Label>Password :</Label><br>
                            <input type="password" class="form-control" placeholder="*******" name="password" id="password" required><br>

                            <Label>Konfirmasi Password :</Label><br>
                            <input type="password" class="form-control" placeholder="*******" name="password2" id="password2" required><br>

                            <input type="submit" class="btn btn-dark form-control" name="register" value="Register">
                            <p class="d-flex justify-content-center mt-5" >Sudah Punya Akun ?  <a href="login.php">Masuk</a></p>
                        </form>
                    </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
</body>
</html>
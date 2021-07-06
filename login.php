<?php
    session_start();
    include 'koneksi.php';

    // cek cookie
    if(isset($_COOKIE["kepo"]) && isset($_COOKIE["apaya"])){
        $id= $_COOKIE["kepo"];
        $username=$_COOKIE["apaya"];
        $result = mysqli_query($conn, "SELECT username FROM user WHERE id = '$id'");
        $row = mysqli_fetch_assoc($result);

        if($username === hash('whirlpool', $row["username"])){
            $_SESSION['login'] = true;

        }
    }

    if(isset($_SESSION["login"])){
        header("Location: index.php");
    }

    if(isset($_POST["login"])){
        $username = $_POST["username"];
        $password = $_POST["password"];

        $check = mysqli_query($conn, "SELECT * FROM user WHERE username = '$username'");

        //cek username ada atau tidak
        if(mysqli_num_rows($check) === 1){

            //cek passwordnya
            $row = mysqli_fetch_assoc($check);
            if(password_verify($password, $row["password"])){
                
                //atur session
                $_SESSION["login"] = true;

                //cek remember me 
                if(isset($_POST["remember"])){
                    //create cookie
                    setcookie('kepo', $row["id"], time() + 3600);
                    setcookie('apaya', hash('whirlpool', $row["username"]),time() + 3600);
                }

                header("Location: index.php");
                exit;
            }
        }
        $error = true;   
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="shortcut icon" href="img/UNDIKSHA.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container mt-5 p-5">
        <div class="row no-grutter">
                <div class="col-lg-5">
                    <img src="img/login.png" alt="Test" class="img-fluid mt-5">
                </div>
                <div class="col-lg-5 ps-5 pt-5">
                    <div class="header">
                        <h1 class="font-weight-bold pt-2 d-flex justify-content-center">Login</h1>
                    </div>
                    <?php if(isset($error)) : ?>
                        <div class="alert alert-danger">
                            <p>Username atau Password Salah</p>
                        </div>
                    <?php endif; ?>
                    <div class="form pb-5 pe-3">
                        <form action="" method="post">
                            <Label>Username :</Label><br>
                            <input type="text" class="form-control" placeholder="Username" name="username" id="username" required><br>

                            <Label>Password :</Label><br>
                            <input type="password" class="form-control" placeholder="********" name="password" id="password" required><br>

                            <input type="checkbox" class="" name="remember" id="remember">
                            <label for="remember">Remember Me</label>
                            
                            <input type="submit" class="btn btn-dark  form-control" name="login" value="Login">

                            <p class="d-flex justify-content-center mt-5" >Belum Punya Akun ?  <a href="Register.php"> Daftar</a></p>
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
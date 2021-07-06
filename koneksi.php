<!--Ini adalah file yang berfungsi sebagai penghubung PHP dengan MySQL -->
<!--Saya merancangnya mirip seperti file .env di Laravel, supaya mudah tinggal panggil di file lain saja-->
<?php 
    $servername = "localhost";   // nama servername
    $username = "root";  // nama default DB
    $password = "";       // password Default
    $dbname = "si_dosen";  //Ini nama DB yang digunakan pada sistem

    $conn = mysqli_connect($servername, $username, $password, $dbname); //variabel yang digunakan untuk koneksi

    if($conn){
        
    }else{
        die("Connection failed : ".mysqli_connect_error()); // Kalau gagal terhubung muncul pesan ini
    }

    function register($data){
        global $conn;
        $username = strtolower(stripcslashes($data["username"]));
        $password = mysqli_real_escape_string($conn, $data["password"]);
        $password2 = mysqli_real_escape_string($conn, $data["password2"]);

        //cek username
        $check = mysqli_query($conn,"SELECT username FROM user WHERE username = '$username'");
        if(mysqli_fetch_assoc($check)){
            echo " <script>
                    alert('Username telah terdaftar, silahkan pilih yang lain');
                    </script>
            ";
            return false;
        }

        //Confirm Password
        if($password !== $password2){
            echo " <script>
                    alert('Konfirmasi Password Gagal');
                    </script>
            ";
            return false;
        }

        //encrypt password
        $password = password_hash($password,PASSWORD_DEFAULT);

        //add new user
        $sql = "INSERT INTO `user`(`username`, `password`) VALUES ('$username','$password')";
        mysqli_query($conn,$sql);

        return mysqli_affected_rows($conn);
    }
?>
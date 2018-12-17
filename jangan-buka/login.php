<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Login</title>
    <?php include('../config/style.php') ?>
</head>

<body>
    <div class="container">
       <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h1 align="center">Login Admin</h1>
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="" class="label-group">Username</label>
                        <input type="text" name="username"  required class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="" class="label-group">Kata Sandi</label>
                        <input type="password" name="password" required class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" name="Login" value="Masuk" class="form-control btn btn-primary">
                    </div>
                    <?php
                        include("../config/db.php");
                        if(isset($_POST['Login']) == "Masuk"){
                            $username       =   $_POST['username'];
                            $password       =   md5($_POST['password']);
                            $query_admin    =   "SELECT*FROM admin where username = '$username' and kata_sandi = '$password'";
                            $query_admin_go =   mysqli_query($db,$query_admin);
                            if(mysqli_num_rows($query_admin_go) > 0){
                                echo "Login berhasil";
                                while($row = mysqli_fetch_array($query_admin_go)){
                                    session_start();
                                    $_SESSION['username']   =   $row['username'];
                                    $_SESSION['nama']       =   $row['nama_admin'];
                                    $_SESSION['level']      =   $row['level'];
                                    header("location:../jangan-buka/home.php");
                                }
                            }else{
                                echo "login gagal";
                            }
                        }
                    ?>
                </form>
            </div>
            <div class="col-sm-3"></div>
       </div>
    </div>
</body>
<?php include('../config/script.php') ?>
</html>
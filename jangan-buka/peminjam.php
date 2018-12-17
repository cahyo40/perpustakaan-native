<?php
    session_start();
    include('../config/db.php');
    if(count($_SESSION)==0){
        header("location:../jangan-buka/login.php");
    }
    if(isset($_GET['aksi'])== "keluar" ){
        session_destroy();
        header("location:../jangan-buka/login.php");
    }
    $query_buku_all     =   "SELECT*FROM buku";
    $query_buku_all_go  =   mysqli_query($db,$query_buku_all);
    $query_peminjam_all =   "SELECT*FROM peminjam";
    $query_peminjam_all_go = mysqli_query($db,$query_peminjam_all);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <?php include('../config/style.php'); ?>
    <title>Tambah Peminjam</title>
</head>
<?php if($_SESSION['level'] == 2){ ?>
  <body class="hold-transition skin-green sidebar-mini">
<?php }else{?>
  <body class="hold-transition skin-red-light sidebar-mini">
<?php }  ?>
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="../jangan-buka/home.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>P</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>Perpustakaan</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <span class="hidden-xs"><?php echo $_SESSION['nama'] ?> (L : <?php echo $_SESSION['level'] ?>)</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <p>
                  <?php echo $_SESSION['nama'] ?>
                  <small>Username : <?php echo $_SESSION['username']  ?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-right">
                  <a href="?aksi=keluar" class="btn btn-default btn-flat">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi Utama</li>
        <li class="treeview">
            <li><a href="../jangan-buka/peminjam.php"><i class="fa fa-user"></i> <span>Tambah Peminjam</span></a></li>
            <li><a href="../jangan-buka/buku.php"><i class="fa fa-book"></i> <span>Olah Buku</span></a></li>
            <?php if($_SESSION['level'] == 2){ ?>
                <li><a href="../jangan-buka/admin.php"><i class="fa fa-user"></i> <span>Olah Admin</span></a></li>
            <?php } ?>
        </li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
       Dashboard
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

        <div class="row">
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-book"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Semua Buku</span>
              <span class="info-box-number"><?php echo mysqli_num_rows($query_buku_all_go); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Peminjam Buku</span>
              <span class="info-box-number"><?php echo mysqli_num_rows($query_peminjam_all_go); ?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title"> Tambah Peminjam</h3>
        </div>
        <div class="box-body">
        <form action="../jangan-buka/proses/proses.php" method="post">
        <div class="form-group">
            <label for="" class="label-control">Nama Peminjam</label>
            <input type="text" name="nama_peminjam" required class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="label-control">Alamat</label>
            <input type="text" name="alamat" required class="form-control">
        </div>
        <div class="form-group">
            <label for="" class="label-control">Jenis Kelamin</label>
            <select required name="jk" class="form-control">
              <option value="laki-laki">Laki-Laki</option>
              <option value="perempuan">Perempuan</option>
            </select>
        </div>
         <table class="table" id="tabelBukuPeminjam">
         <thead>
            <tr>
              <th>No.</th>
              <th>Judul</th>
              <th>Banyak Buku</th>
              <th>Pilih</th>
            </tr>
            </thead>
              <?php 
              $no = 1;
                while($row = mysqli_fetch_array($query_buku_all_go)){
              ?>
              <tbody>
               <tr>
              <td><?php echo $no++ ?></td> 
              <td><?php echo $row['judul_buku']?></td>
              <td><?php echo $row['stok_buku']?></td>
              <td><input type="checkbox" name="pilihan[]" value="<?php echo $row['id_buku'] ?>"></td>
              </tr>
              </tbody>
                <?php } ?>
            
         </table>
            <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="" class="label-control">Tanggal Pinjam</label>
                      <input required type="date" name="tgl_pinjam" id="" class="form-control">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label for="" class="label-control">Tanggal Kembali</label>
                      <input required type="date" name="tgl_kembali" id="" class="form-control">
                    </div>
                  </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Proses" name="peminjaman" class="btn btn-primary">
            </div>
         </form>
        </div>
      </div>

    </section>
  </div>
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Dibuat oleh Muchammad Dwi Cahyo Nugroho</b>
    </div>
  </footer>

      
</div>
<?php include('../config/script.php')?>
</body>

</html>
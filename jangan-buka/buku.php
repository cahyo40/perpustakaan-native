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
    $level = $_SESSION['level'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <?php include('../config/style.php'); ?>
    <title>Daftar Buku</title>
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
              <span class="hidden-xs"><?php echo $_SESSION['nama'] ?> (L : <?php echo $level ?>)</span>
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

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi Utama</li>
        <li class="treeview">
        <li><a href="../jangan-buka/peminjam.php"><i class="fa fa-user"></i> <span>Tambah Peminjam</span></a></li>
        <li><a href="../jangan-buka/history.php"><i class="fa fa-clock-o"></i> <span>Riwayat Peminjaman</span></a></li>
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
              <span class="info-box-number"><?php echo mysqli_num_rows($query_buku_all_go); ?></span></span>
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
          <h3 class="box-title">Daftar Buku</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip"
                    title="Collapse">
              <i class="fa fa-minus"></i></button>
          </div>
        <div class="box-body">
            <div class="container-fluid pull-right">
                
            </div>
            <div class="table-responsive" style="margin-top:50px">
                <table class="table" id="daftarBuku">
                    <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul Buku</th>
                        <th>Banyak Buku</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $no =1;
                            while($buku = mysqli_fetch_array($query_buku_all_go)){
                        ?>
                            <tr>
                                <td><?php echo $no++ ?></td>
                                <td><?php echo $buku['judul_buku']; ?></td>
                                <td><?php echo $buku['stok_buku']; ?></td>
                                <td>
                                   <ul>
                                   <li>Penulis : <?php echo $buku['penulis']; ?> </li>
                                    <li>Penerbit : <?php echo $buku['penerbit']; ?> </li>
                                    <li>Tahun Terbit : <?php echo $buku['tahun_terbit']; ?> </li>
                                    <li>Keterangan Lain: <?php echo $buku['keterangan']; ?> </li>
                                   </ul>
                                </td>
                                <td>
                                    <div>
                                        <a href="../jangan-buka/proses/proses.php?delete=<?php echo $buku['id_buku'] ?>" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                        <a href="#" class="btn btn-warning" data-toggle="modal" data-target="#edit<?php echo $buku['id_buku'] ?>"><i class="fa fa-cog"></i></a>
                                        <?php include('../jangan-buka/form/edit_buku.php') ?>
                                    </div>
                                </td>
                            </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
      </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Buku</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Tambah Buku">
              <i class="fa fa-minus"></i></button>
          </div>
          <div class="box-body">
              <?php include('../jangan-buka/form/tambah.php') ?>
          </div>
        </div>
      </div>
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Buku</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Tambah Buku">
              <i class="fa fa-minus"></i></button>
          </div>
          <div class="box-body">
              <?php include('../jangan-buka/form/jenis_buku.php') ?>
          </div>
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
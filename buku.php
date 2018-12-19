
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <?php include('config/db.php') ?>
  <title>Perpustakaan</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="stylesheet" href="config/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="config/bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="config/bower_components/Ionicons/css/ionicons.min.css">
  <link rel="stylesheet" href="config/dist/css/AdminLTE.min.css">
  <link rel="stylesheet" href="config/dist/css/skins/_all-skins.min.css">
  <link rel="stylesheet" href="glow.css">
  <link rel="stylesheet" href="config/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="index.php" class="navbar-brand"><b>Perpustakaan</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>

        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
        <ul class="nav navbar-nav">
            <li><a href="#">Daftar buku</a></li>
            <li><a href="jangan-buka/login.php">Login Admin</a></li>
        </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header>
  <!-- Full Width Column -->
  <div class="content-wrapper">
    <div class="container">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="thumbnail container">
            <div class="jumbotron">
                <h1>Perpustakaan Mantap</h1> 
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quae molestias recusandae voluptate corrupti vitae fuga vel perferendis iure ipsum fugiat odio error, ullam eius expedita animi dignissimos neque. Aut, magnam?</p> 
            </div>
        </div>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="thumbnail container">
            <div class="container">
                <h3 align="center">Daftar Seluruh Buku</h3>
                <div class="glow-div"></div>
                <table class="table table-bordered" id="daftarBuku">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun Tebit</th>
                        <th>Penerbit</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                <?php 
                    $no =1;
                    $daftar_buku        = "SELECT*FROM buku";
                    $daftar_buku_go     = mysqli_query($db,$daftar_buku);
                    while($row=mysqli_fetch_array($daftar_buku_go)){
                ?>
                    <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $row['judul_buku'] ?></td>
                        <td><?php echo $row['penulis'] ?></td>
                        <td><?php echo $row['tahun_terbit'] ?></td>
                        <td><?php echo $row['penerbit'] ?></td>
                        <td>
                            <div>
                                Buku tersedia : <?php echo $row['stok_buku'] ?>
                            </div>
                            <div>
                                Keterangan Lain : <?php echo $row['keterangan'] ?>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                    </table>
                    <div class="glow-div-2"></div>
            </div>
        </div>
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
</div>

<script src="config/bower_components/jquery/dist/jquery.min.js"></script>
<script src="config/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="config/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="config/bower_components/fastclick/lib/fastclick.js"></script>
<script src="config/dist/js/adminlte.min.js"></script>
<script src="config/dist/js/demo.js"></script>
<script src="config/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="config/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#daftarBuku').DataTable();
  })
</script>
</body>
</html>

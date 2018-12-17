<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('config/db.php') ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Halaman Utama</title>
    <link rel="stylesheet" href="config/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="config/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="config/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
</head>
<style>
    .glow-div {
    width: 100%;
    height: 10px;
    text-align: center;
    line-height: 20px;
    color: #fff;
    font-size: 12px;
    text-transform: uppercase;
    text-decoration: none;
    font-family: sans-serif;
    box-sizing: border-box;
    background: linear-gradient(90deg, #00bcd4, #1b5e20, #2196f3, #00bcd4);
    background-size: 400%;
    animation: animate 10s linear infinite;
    margin-top: 10px;
    margin-bottom: 10px;
}
@keyframes animate {
    0% {
        background-position: 0%;
    }

    100% {
        background-position: 400%;
    }
}
</style>
<body>
    <div class="glow-div"></div>
    <div>
        <table class="table table-hover" id="daftarbuku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Penerbit</th>
                    <th>Banyak Buku</th>
                </tr>
            </thead>
            <tbody>
            <?php 
                $no = 1;
                $query_buku = "SELECT*FROM buku";
                $query_buku_go = mysqli_query($db,$query_buku);
                while($row = mysqli_fetch_array($query_buku_go)){
            ?>
                <tr>
                    <td><?php echo $no++ ?></td>
                    <td><?php echo $row['judul_buku'] ?></td>
                    <td><?php echo $row['penulis'] ?></td>
                    <td><?php echo $row['tahun_terbit'] ?></td>
                    <td><?php echo $row['penerbit'] ?></td>
                    <td><?php echo $row['stok_buku'] ?></td>
                </tr>
<?php } ?>
            </tbody>
        </table>
        <div class="glow-div"></div>
    </div>
    <script src="config/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="config/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="config/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(function () {
        $('#daftarbuku').DataTable();
    })
    </script>
</body>
</html>
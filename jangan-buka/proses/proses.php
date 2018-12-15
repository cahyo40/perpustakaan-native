<?php 
include('../../config/db.php');
//tambah buku
if(isset($_POST['simpan']) == "Simpan"){
    $judul_buku         =   $_POST['judul_buku'];
    $keterangan         =   $_POST['keterangan'];
    $jenis_buku         =   $_POST['jenis_buku'];
    $tahun_terbit       =   $_POST['tahun_terbit'];
    $penerbit           =   $_POST['penerbit'];
    $penulis            =   $_POST['penulis'];
    $stok_buku          =   $_POST['stok_buku'];
    $query_add_buku     =   "INSERT INTO buku VALUES(null,'$judul_buku','$keterangan',null,'$jenis_buku','$tahun_terbit','$penerbit','$penulis','$stok_buku')";
    $query_add_buku_go  =   mysqli_query($db,$query_add_buku);
    header('location:../buku.php');
}
//tambah jenis buku
if(isset($_POST['jenis_buku'])){
    $judul_buku         =   strtolower($_POST['jenis']);
    $query_jenis_buku   =   "INSERT INTO jenis_buku VALUES(null,'$judul_buku')";
    $query_jenis_buku_go    = mysqli_query($db,$query_jenis_buku);
    header('location:../buku.php');
}
//hapus buku
if(isset($_GET['delete'])){
   $id  = $_GET['delete'];
   $query_del_buku      =   "DELETE FROM buku WHERE id_buku = $id";
   $query_del_buku_go   =   mysqli_query($db,$query_del_buku);
   header('location:../buku.php');
}
?>
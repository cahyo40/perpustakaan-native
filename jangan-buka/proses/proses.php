<?php 
include('../../config/db.php');
//tambah jenis buku
if(isset($_POST['kategori']) == "Tambah"){
    if($_POST['kategori']==null){
        header('location:../buku.php');
    }else{
    $judul_bukus             =   strtolower($_POST['jenis']);
    $query_jenis_buku       =   "INSERT INTO kategori VALUES(null,'$judul_bukus')";
    $query_jenis_buku_go    =   mysqli_query($db,$query_jenis_buku);
    header('location:../buku.php');
    }
}
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

//hapus buku
if(isset($_GET['delete'])){
   $id  = $_GET['delete'];
   $query_del_buku      =   "DELETE FROM buku WHERE id_buku = $id";
   $query_del_buku_go   =   mysqli_query($db,$query_del_buku);
   header('location:../buku.php');
}

//edit buku
if(isset($_GET['ubah'])){
    $id_buku_edit   =   $_GET['ubah'];
   $edit_judul      =   $_POST['edit_judul'];
   $edit_penulis    =   $_POST['edit_penulis'] ;
   $edit_tahun      =   $_POST['edit_tahun'];
   $edit_penerbit  =   $_POST['edit_penerbit'];
   $edit_jenis      =   strtolower($_POST['edit_jenis']);
   $edit_stok       =   $_POST['edit_stok'];
   $edit_keterangan =   $_POST['edit_keterangan'];
   $query_update_buku = "UPDATE buku SET judul_buku='$edit_judul',keterangan='$edit_keterangan',jenis_buku='$edit_jenis',tahun_terbit='$edit_tahun',penerbit='$edit_penerbit',penulis='$edit_penulis',stok_buku='$edit_stok' WHERE id_buku = $id_buku_edit";
   $query_update_buku_go = mysqli_query($db,$query_update_buku);
   header('location:../buku.php');
}
?>
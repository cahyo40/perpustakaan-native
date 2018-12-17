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
   $edit_penerbit   =   $_POST['edit_penerbit'];
   $edit_jenis      =   strtolower($_POST['edit_jenis']);
   $edit_stok       =   $_POST['edit_stok'];
   $edit_keterangan =   $_POST['edit_keterangan'];
   $query_update_buku = "UPDATE buku SET judul_buku='$edit_judul',keterangan='$edit_keterangan',jenis_buku='$edit_jenis',tahun_terbit='$edit_tahun',penerbit='$edit_penerbit',penulis='$edit_penulis',stok_buku='$edit_stok' WHERE id_buku = $id_buku_edit";
   $query_update_buku_go = mysqli_query($db,$query_update_buku);
   header('location:../buku.php');
}

if(isset($_POST['peminjaman'])== "Proses"){
    $pilihan[]          = $_POST['pilihan'] ;
    $peminjam           = $_POST['nama_peminjam'];
    $alamat             = $_POST['alamat'];
    $jk                 = $_POST['jk']  ;
    $id_peminjam =null;
    //menginsert data peminjam
    $query_add_peminjam = "INSERT INTO peminjam VALUES(null,'$peminjam','$alamat','$jk')";
    $query_add_peminjam_go = mysqli_query($db,$query_add_peminjam);
    //mendapatkan id peminjam
    $get_id_peminjam = "SELECT id_peminjam FROM peminjam ORDER BY id_peminjam DESC LIMIT 1";
    $get_id_peminjam_go = mysqli_query($db,$get_id_peminjam);
    $row = mysqli_fetch_array($get_id_peminjam_go);
    $id_peminjam = $row['id_peminjam'];
    //menambahkan ke meminjam
    $tgl_pinjam         = $_POST['tgl_pinjam'];
    $tgl_kembali        = $_POST['tgl_kembali'];
    for($i=0;$i<count($_POST['pilihan']);$i++){
        foreach($pilihan as $pilih){
            $query_peminjam = "INSERT INTO meminjam VALUES(null,$pilih[$i],$id_peminjam,'$tgl_pinjam','$tgl_kembali',null,null,'dipinjam')";
            $query_peminjam_go = mysqli_query($db,$query_peminjam);
            $query_update_stok = "UPDATE buku SET stok_buku = stok_buku-1 where id_buku = $pilih[$i]";
            $query_update_stok_go = mysqli_query($db,$query_update_stok);
        }
    }
    header('location:../peminjam.php');
}
    if(isset($_GET['batal'])){
        $id_peminjam = $_GET['batal'];
        $query_batal_minjam     = "UPDATE meminjam SET status='dibatalkan' Where id_peminjam=$id_peminjam";
        $query_stok             = "SELECT*FROM meminjam where id_peminjam=$id_peminjam";
        $query_stok_go          = mysqli_query($db,$query_stok);
        while($stok = mysqli_fetch_array($query_stok_go)){
            $stoks = $stok['id_buku'];
            $query_balik_stok   = "UPDATE buku SET stok_buku = stok_buku+1 where id_buku=$stoks";
            $query_balik_stok_go    = mysqli_query($db,$query_balik_stok);
        }
        $query_batal_minjam_go  = mysqli_query($db,$query_batal_minjam);
        header('location:../home.php');
    }
    if(isset($_GET['kembali'])){
        $id_peminjam = $_GET['kembali'];
        $query_batal_minjam     = "UPDATE meminjam SET status='dikembalikan' Where id_peminjam=$id_peminjam";
        $query_stok             = "SELECT*FROM meminjam where id_peminjam=$id_peminjam";
        $query_stok_go          = mysqli_query($db,$query_stok);
        while($stok = mysqli_fetch_array($query_stok_go)){
            $stoks = $stok['id_buku'];
            $query_balik_stok   = "UPDATE buku SET stok_buku = stok_buku+1 where id_buku=$stoks";
            $query_balik_stok_go    = mysqli_query($db,$query_balik_stok);
        }
        $query_batal_minjam_go = mysqli_query($db,$query_batal_minjam);
        header('location:../home.php');
    }
?>
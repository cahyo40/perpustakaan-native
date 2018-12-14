<div id="tambahBuku" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Tambah Buku</h4>
      </div>
      <div class="modal-body">
        <form action="#" method="post">
            <div class="form-group">
                <label for="" class="label-control">Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Penulis</label>
                <input type="text" name="penulis" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Tahun Terbit</label>
                <input type="number" min="1900" max="2200" name="tahun_terbit" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Penerbit</label>
                <input type="text" name="penerbit" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Jenis Buku</label>
                <input type="text" name="jenis_buku" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Banyak Buku</label>
                <input type="number" name="stok_buku" class="form-control">
            </div>
            <div class="form-group">
                <label for="" class="label-control">Keterangan</label>
                <textarea name="keterangan"cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            </div>
        </form>
      </div>
    </div>

  </div>
</div>

<?php 
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
}
?>
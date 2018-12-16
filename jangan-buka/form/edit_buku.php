<div id="edit<?php echo $buku['id_buku'] ?>" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
      Ubah data buku : <?php echo $buku['judul_buku'] ?>
    </div>
      <div class="modal-body">
        <table>
        <form action="../jangan-buka/proses/proses.php?ubah=<?php echo $buku['id_buku'] ?>" method="post">
          <tr>
            <td><label for="">Judul Buku</label></td>
            <td style="width:80px">:</td>
            <td><input type="text" name="edit_judul" value="<?php echo $buku['judul_buku'] ?>" class="form-control" required></td>
          </tr>
          <tr>
            <td><label for="">Penulis</label></td>
            <td style="width:80px">:</td>
            <td><input type="text" name="edit_penulis" value="<?php echo $buku['penulis'] ?>" class="form-control" required></td>
          </tr>
          <tr>
            <td><label for="">Tahun Terbit</label></td>
            <td style="width:80px">:</td>
            <td><input type="number" min="1900" max="2200" name="edit_tahun" value="<?php echo $buku['tahun_terbit'] ?>" required class="form-control"></td>
          </tr>
          <tr>
            <td><label for="">Penerbit</label></td>
            <td style="width:80px">:</td>
            <td><input type="text" name="edit_penerbit" value="<?php echo $buku['penerbit'] ?>" class="form-control" required></td>
          </tr>
          <tr>
            <td><label for="">Jenis Buku</label></td>
            <td style="width:80px">:</td>
            <td>
              <select class="form-control" name="edit_jenis" required>
                  <option value="<?php echo strtoupper($buku['jenis_buku']) ?>"><?php echo strtoupper($buku['jenis_buku']) ?></option>
                  <?php 
                        $jenis = $buku['jenis_buku'];
                        $query_jenis    =     "SELECT*FROM kategori where not jenis_buku = '$jenis' ";
                        $query_jenis_go =   mysqli_query($db,$query_jenis);
                        while($row = mysqli_fetch_array($query_jenis_go)){
                    ?>
                        <option value="<?php echo $row['jenis_buku'] ?>"><?php echo strtoupper($row['jenis_buku']) ?></option>
                    <?php } ?>
              </select>
            </td>
          </tr>
          <tr>
            <td><label for="">Banyak Buku</label></td>
            <td style="width:80px">:</td>
            <td><input required type="number" name="edit_stok" value="<?php echo $buku['stok_buku'] ?>" class="form-control"></td>
          </tr>
          <tr>
            <td><label for="">Keterangan</label></td>
            <td style="width:80px">:</td>
            <td><textarea required name="edit_keterangan" class="form-control"cols="30" rows="10"><?php echo $buku['keterangan'] ?></textarea></td>
          </tr>
          <tr>
            <td><input class="btn btn-warning" type="submit" name="tombol_edit" value="Ubah"></td>
          </tr>
          </form>
        </table>
      </div>
    </div>

  </div>
</div>
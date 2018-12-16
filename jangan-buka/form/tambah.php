        <form action="../jangan-buka/proses/proses.php" method="post">
            <div class="form-group">
                <label for="" class="label-control">Judul Buku</label>
                <input type="text" name="judul_buku" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Penulis</label>
                <input type="text" name="penulis" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Tahun Terbit</label>
                <input type="number" min="1900" max="2200" name="tahun_terbit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Penerbit</label>
                <input type="text" name="penerbit" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Jenis Buku</label>
                <select name="jenis_buku" class="form-control" required>
                    <option value="">Pilih</option>
                    <?php 
                        $query_jenis    =     "SELECT*FROM kategori ORDER BY jenis_buku ASC ";
                        $query_jenis_go =   mysqli_query($db,$query_jenis);
                        while($row = mysqli_fetch_array($query_jenis_go)){
                    ?>
                        <option value="<?php echo $row['jenis_buku'] ?>"><?php echo strtoupper($row['jenis_buku']) ?></option>
                    <?php } ?>
                </select>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Banyak Buku</label>
                <input type="number" name="stok_buku" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="" class="label-control">Keterangan</label>
                <textarea name="keterangan"cols="30" rows="10" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <input type="submit" name="simpan" value="Simpan" class="btn btn-primary" >
            </div>
        </form>

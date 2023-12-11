    <?php
      include_once '../lib/produk.php';

      $produk = new produk();
      $idPenjual = $_GET['id'];

      if(isset($_GET['aksi'])){
        if($_GET['aksi'] == 'ubah-produk'){
          if(isset($idPenjual) && isset($_GET['idProduk'])){
            // Mendapatkan Data produk Dari Database Untuk otomatisasi isi form edit
            $getDataProduk = $produk->getDataProduk($_GET['idProduk']);

            if (mysqli_num_rows($getDataProduk)) {
                // Data Produk
                $dataProduk = mysqli_fetch_assoc($getDataProduk);
                $namaProduk = $dataProduk['namaProduk'];
                $deskripsiProduk = $dataProduk['deskripsi'];
                $hargaProduk = $dataProduk['harga'];
                $diskonProduk = $dataProduk['diskon'];
                $kategori = $dataProduk['kategori'];
                $variasiProduk = $dataProduk['variasiProduk'];
                $ukuranProduk = $dataProduk['ukuranProduk'];
                $stokProduk = $dataProduk['stokProduk'];
                $fotoProduk = $dataProduk['fotoProduk'];
            } else {
                echo "<script>
                alert('Data Tidak Ditemukan.');
                </script>";;
            }
          }
        } else if($_GET['aksi'] == 'hapus-produk'){
          if(isset($idPenjual) && isset($_GET['idProduk'])){
            $idProduk = $_GET['idProduk'];
            $hapusStok = $produk->hapusProduk($idPenjual, $idProduk);
          }
        }
      }


      // pengecekan apakah method post pada form sudah terjadi dengan merujuk pada submit
      if(isset ($_POST['submit'])) {
        if($_GET['aksi'] == 'ubah-produk'){
          $idProduk = $_GET['idProduk'];
          $editProduk = $produk->editProduk($_POST, $idProduk, $fotoProduk);
        } else {
          $tambahProduk = $produk->tambahProduk($_POST, $idPenjual);
        }
      }

      if (isset($_GET['success'])) {
          echo '<script>
          alert("Data Berhasil Ditambahkan.")
          </script>';
      }
    ?>
    <form action="" method="POST" id="form-produk" class="form-produk" enctype="multipart/form-data">
      <div class="m-0 bg-gray border-bottom border-2">
        <nav class="d-flex align-items-center p-2">
          <a onclick="history.back()" class="me-3"><i class="bi bi-arrow-left fs-3"></i></a>
          <span>Tambah Produk</span>
          <button type="submit" name="submit" class="btn bg-green text-white ms-auto">Simpan</button>
        </nav>
      </div>

      <div class="mt-2 pt-2 pb-2 bg-gray">
        <div class="p-2">
          <label for="fotoProduk">Foto Produk</label>
          <hr />
          <input type="file" accept="image/png, image/jpg, image/jpeg" name="fotoProduk[]" id="fotoProduk" class="mt-2" multiple <?= $_GET['aksi'] == 'ubah-produk' ? '' : 'required' ?> />
        </div>

        <div class="mt-2 p-2">
          <label for="namaProduk">Nama Produk</label>
          <hr />
          <input type="text" placeholder="Masukkan nama produk" name="namaProduk" id="namaProduk" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $namaProduk ?>" required />
        </div>

        <div class="mt-2 p-2">
          <div class="d-flex justify-content-between">
            <label for="deskripsiProduk">Deskripsi Produk</label>
            <span><span id="hitung">0</span>/500</span>
          </div>
          <hr />
          <textarea class="form-control bg-gray border-0 ps-0 pe-0" name="deskripsiProduk" id="deskripsiProduk" placeholder="Masukkan deskripsi produk" maxlength="500" rows="3" onkeyup="hitungKarakter(this.value)" required><?=@ $deskripsiProduk ?></textarea>
        </div>

        <div class="mt-2 p-2">
          <label for="hargaProduk">Harga</label>
          <hr />
          <div class="input-group mt-2">
            <span class="input-group-text bg-green text-white border-0">Rp</span>
            <input type="number" placeholder="Masukkan harga produk" name="hargaProduk" id="hargaProduk" class="form-control bg-gray border-0" value="<?=@ $hargaProduk ?>" required />
          </div>
        </div>

        <div class="mt-2 p-2">
          <label for="diskonProduk">Diskon</label>
          <hr />
          <div class="input-group mt-2">
            <input type="number" placeholder="Masukkan diskon produk" name="diskonProduk" id="diskonProduk" class="form-control bg-gray border-0 ps-0" value="<?=@ $diskonProduk ?>" required />
            <span class="input-group-text bg-green text-white border-0">%</span>
          </div>
        </div>
      </div>

      <div class="mt-2 pt-2 pb-2 bg-gray">
        <div class="mt-2 p-2">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <label for="kategoriProduk">Kategori</label>
            <select class="form-select form-select-sm bg-gray" name="kategoriProduk" id="kategoriProduk" style="width: 37vw">
              <option>Pilih Kategori</option>
              <option value="Pakaian" <?=@ $kategori == 'Pakaian' ? 'selected' : ''?> >Pakaian</option>
              <option value="Tas" <?=@ $kategori == 'Tas' ? 'selected' : ''?> >Tas</option>
            </select>
          </div>
          <hr />
        </div>

        <div class="mt-2 p-2">
          <label for="variasiProduk">Variasi</label>
          <hr/>
          <div class="input-group mt-2">
            <input type="text" placeholder="Masukkan variasi" name="variasiProduk" id="variasiProduk" class="form-control bg-gray border-0 ps-0 pe-0 mb-3" value="<?=@ $variasiProduk ?>" required/>
          </div>

        </div>

        <div class="mt-2 p-2">
          <label for="ukuranProduk">Ukuran</label>
          <hr />
          <div class="input-group mt-2">
            <input type="text" placeholder="Masukkan ukuran" name="ukuranProduk" id="ukuranProduk" class="form-control bg-gray border-0 ps-0 pe-0 mb-3" value="<?=@ $ukuranProduk ?>" required/>
          </div>
        </div>

        <div class="mt-2 p-2">
          <label for="stokProduk">Masukkan Stok</label>
          <hr />
          <input type="number" placeholder="Masukkan stok produk" name="stokProduk" id="stokProduk" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $stokProduk ?>" required />
        </div>
      </div>
    </form>

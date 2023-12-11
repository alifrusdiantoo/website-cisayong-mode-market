    <?php 
      include_once '../lib/produk.php';

      // instansiasi objek produk
      $produk = new produk();

      if(isset($_GET['id'])){
        // Ambil id produk yang akan ditampilkan
        $id = $_GET['id'];

        $getDataProduk = $produk->getDataProduk($id);
        $fotoProduk = $produk->tampilFotoProduk($id);

        if (!empty(mysqli_num_rows($getDataProduk))) {
            // Ambil data toko
            $dataProduk = mysqli_fetch_assoc($getDataProduk);
            $namaProduk = $dataProduk['namaProduk'];
            $harga = $dataProduk['harga'];
            $diskon = $dataProduk['diskon'];
            $fotoProfil = $dataProduk['fotoProfil'];
            $idPenjual = $dataProduk['idPenjual'];
            $namaToko = $dataProduk['namaToko'];
            $telepon = $dataProduk['telepon'];
            $jmlProduk = implode($produk->hitungProduk($dataProduk['idPenjual']));
            $deskripsi = $dataProduk['deskripsi'];
            $ukuranProduk = $dataProduk['ukuranProduk'];
            $variasiProduk = $dataProduk['variasiProduk'];
            $stokProduk = $dataProduk['stokProduk'];
        } else {
            echo "<script>
            alert('Data Tidak Ditemukan.');
            history.back();
            </script>";
        }
      }
    ?>
    <!-- Foto produk start -->
    <div class="foto-produk">
      <div id="fotoProduk" class="carousel slide" data-bs-ride="carousel">
        <!-- Indikator Carousel -->
        <div class="carousel-indicators">
          <?php $index = 0; foreach ($fotoProduk as $foto): ?>
              <button type="button" data-bs-target="#fotoProduk" data-bs-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="true" aria-label="Slide <?php echo $index + 1; ?>"></button>
          <?php $index++; endforeach; ?>
        </div>

        <!-- Content Carousel -->
        <div class="carousel-inner">
          <?php $i = 0; foreach ($fotoProduk as $foto): ?>
              <div class="carousel-item <?php echo $i === 0 ? 'active' : ''; ?>">
                  <img src="../content/img/product/<?php echo $foto['fotoProduk']; ?>" class="d-block w-100" height="350" alt="Carousel Item">
              </div>
          <?php $i++; endforeach; ?>
        </div>

        <!-- Navigasi Carousel -->
        <button class="carousel-control-prev" type="button" data-bs-target="#fotoProduk" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#fotoProduk" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>

        <!-- Close Page -->
        <a onclick="history.back()" class="close"><i class="bi bi-x-circle-fill"></i></a>
      </div>
    </div>
    <!-- Foto produk end -->

    <!-- Awal Section Data Produk -->
    <section class="data-produk p-2">
      <!-- Info Produk -->
      <div class="d-flex justify-content-center align-items-center mb-3">
        <div class="d-flex flex-column">
          <b><?= $namaProduk; ?></b>
          <?php 
            $hargaDiskon = number_format($harga - ($harga * $diskon/100), 0, ",", ".");
            $harga = number_format($harga, 0, ",", ".");
            if($diskon != 0 && $diskon > 0){
              echo "<span>Rp$hargaDiskon</span>";
              echo "<span><strike>Rp$harga</strike></span>";
            } else {
              echo "<span>Rp$harga</span>";
            }
          ?>
        </div>
        <div class="ms-auto"><b><?= $diskon; ?>%</b></div>
      </div>

      <!-- Card Toko -->
      <div class="card card-toko mb-4">
        <div class="card-body d-flex align-items-center p-2">
          <img src="../content/img/profil/<?= $fotoProfil?>" alt="" width="40" height="40" class="me-2" />
          <div class="nama">
            <span><?= $namaToko; ?></span>
            <br />
            <span><span class="jml-product"><?= $jmlProduk ?></span> Produk</span>
          </div>
          <a href="?hal=toko&id=<?= $idPenjual ?>" class="btn btn-visit ms-auto <?= cekSuperadmin() ?>">Kunjungi</a>
        </div>
      </div>

      <!-- Rincian Produk -->
      <div>
        <!-- Deskripsi produk -->
        <div>
          <p class="deskripsi-produk">
            Deskripsi
            <br />
            <?= $deskripsi; ?>
          </p>
        </div>

        <!-- Variasi produk -->
        <div class="mb-3">
          <span class="deskripsi-produk">Variasi</span>
          <br />
          <?php 
            $variasi = explode(",", $variasiProduk);
            $jmlvariasi = count($variasi);
            for($i = 0; $i < $jmlvariasi; $i++){
          ?>
            <input type="radio" class="btn-check" name="variasi" id="<?= $variasi[$i]; ?>" value="<?= $variasi[$i] ?>" autocomplete="off" <?= $i == 0 ? 'checked' : '' ?> />
            <label class="btn btn-success" for="<?= $variasi[$i]; ?>"><?= $variasi[$i]; ?></label>
          <?php 
            };
          ?>
        </div>

        <!-- Ukuran produk -->
        <div class="">
          <span class="deskripsi-produk">Ukuran</span>
          <br />
          <?php 
            $ukuran = explode(",", $ukuranProduk);
            $jmlUkuran = count($ukuran);
            for($i = 0; $i < $jmlUkuran; $i++){
          ?>
            <input type="radio" class="btn-check" name="ukuran" id="<?= $ukuran[$i]; ?>" value="<?= $ukuran[$i] ?>" autocomplete="off" <?= $i == 0 ? 'checked' : '' ?> />
            <label class="btn btn-success" for="<?= $ukuran[$i]; ?>"><?= $ukuran[$i]; ?></label>
          <?php 
            };
          ?>
        </div>
      </div>
    </section>
    <!-- Akhir Section Data Produk -->

    <section class="pesan-produk p-2 mt-2 <?= cekSuperadmin() ?>">
      <div class="d-flex justify-content-between align-items-center h-100">
        <span>
          Jumlah Stok : <span><b><?= $stokProduk; ?></b></span>
        </span>
        <a onclick="buatPesanan('<?= $namaProduk ?>', '<?= $telepon ?>');" class="btn btn-visit">Pesan</a>
      </div>
    </section>

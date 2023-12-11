    <?php 
      include_once '../lib/superadmin.php';
      include_once '../lib/produk.php';

      // Instansiasi objek penjual
      $penjual = new penjual();

      $getDataToko = $penjual->getDataToko($_GET['id']);
      $getDataAkun = $penjual->getDataAkun($_GET['id']);

      // instansiasi objek produk
      $produk = new produk();
      $tampilProduk = $produk->tampilProdukToko($_GET['id']);

      if (mysqli_num_rows($getDataToko) == 1){
        $dataToko = mysqli_fetch_assoc($getDataToko);
        $dataAkun = mysqli_fetch_assoc($getDataAkun);

        $fotoProfil = $dataToko['fotoProfil'];
        $namaToko = $dataToko['namaToko'];
        $namaPemilik = $dataAkun['namaPenjual'];
        $telepon = $dataAkun['telepon'];
        $jmlProduk = implode($produk->hitungProduk($dataAkun['idPenjual']));
        $deskripsiToko = $dataToko['deskripsiToko'];
        $alamatToko = $dataToko['alamatToko'];
      }
    ?>

    <!-- Start Header Toko -->
    <section class="header-toko p-2">
      <div class="card card-toko bg-gray">
        <div class="card-body d-flex align-items-center p-2">
          <img src="../content/img/profil/<?= $fotoProfil ?>" alt="" width="60" height="60" class="me-2" />
          <div class="nama flex-fill">
            <span><?= $namaToko; ?></span>
            <br />
            <span><?= $namaPemilik; ?></span>
            <br />
            <span><span class="jml-product"><?= $jmlProduk; ?></span> Produk</span>
          </div>
          <div class="aksi">
            <a href="?hal=toko-saya&aksi=ubah-profil&id=<?= $_GET['id'] ?>" class="btn btn-visit ms-auto">Ubah</a>
          </div>
        </div>
      </div>
    </section>
    <!-- End Header Toko -->

    <!-- Start Content Toko -->
    <section class="tab-toko">
      <ul class="nav nav-pills pe-2 pt-3 pb-3 ps-2" id="pills-tab" role="tablist">
        <li class="nav-item me-2" role="presentation">
          <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Produk</button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Tentang</button>
        </li>
        <li class="nav-item ms-auto">
          <a href="?hal=kelola-produk&id=<?= $_GET['id'] ?>" class="btn btn-visit" type="button">Kelola</a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
          <!-- Daftar Produk Toko -->
          <div class="d-flex flex-wrap justify-content-between">
            <?php
              if (!empty($tampilProduk)):
              foreach ($tampilProduk as $data):
                $harga = $data['harga'];
                $diskon = $data['diskon'];
                $hargaDiskon = number_format($harga - ($harga * $diskon/100), 0, ",", ".");
                $tampilFotoDashboard = $produk->tampilFotoDashboard($data['idProduk']);
            ?>
            <div class="card card-product m-2">
              <a href="?hal=produk&id=<?= $data['idProduk']?>">
              <?php foreach ($tampilFotoDashboard as $foto):?>
                <img src="../content/img/product/<?= $foto['fotoProduk']?>" class="card-img-top" />
              <?php endforeach;?>
                <div class="card-body p-0 ps-2 pe-2">
                  <span class="nama"><?= $data['namaProduk']; ?></span>
                  <div class="d-flex justify-content-between">
                    <span class="harga">Rp<?= $hargaDiskon; ?></span>
                    <span class="diskon"><?= $diskon; ?>%</span>
                  </div>
                </div>
              </a>
            </div>
            <?php 
              endforeach;
            endif;
            ?>
          </div>
        </div>
        <div class="tab-pane fade p-2" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
          <p>
            <b>Deskripsi</b><br />
            <?= $deskripsiToko; ?>
          </p>
          <p><b>Alamat</b> <br /><?= $alamatToko; ?></p></p>
          <p><b>Kontak</b> <br /><?= $telepon; ?></p>
        </div>
      </div>
    </section>
    <!-- End Contert Toko -->

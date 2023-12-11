<?php 
  include_once '../lib/produk.php';
  // instansiasi objek produk
  $produk = new produk();
  $tampilProduk = $produk->tampilProdukBeranda('');
  $tampilTas = $produk->tampilProdukBeranda('Tas');
  $tampilPakaian = $produk->tampilProdukBeranda('Pakaian');
?>
<!-- Hero section start -->
<section class="hero mb-4">
  <main class="content d-flex flex-column justify-content-center text-center text-white">
    <h1>
      <strong>
        CISAYONG
        <br />
        MODE MARKET
      </strong>
    </h1>
    <p>Wear Local, Feel Global</p>
    <button class="btn btn-prim" onclick="window.scrollTo(0, document.getElementById('new-product').offsetTop-55);">Telusuri</button>
  </main>
</section>
<!-- Hero section end -->

<!-- Newest Section Start -->
<section class="new-product d-flex flex-column p-2 mb-3" id="new-product">
  <div class="d-flex justify-content-between section-head mt-2">
    <p>Terbaru</p>
    <a href="?hal=produk">Lihat Semua</a>
  </div>
  <div class="">
    <div class="scrolling-wrapper">
      <?php
        if (!empty($tampilProduk)):
          foreach ($tampilProduk as $data):
            $hargaDiskon = $data['harga'] - ($data['harga'] * $data['diskon'] / 100);
            $harga = number_format($hargaDiskon, 0, ',', '.');
            $tampilFotoDashboard = $produk->tampilFotoDashboard($data['idProduk']);
      ?>
            <div class="card card-product me-2">
              <a href="?hal=produk&id=<?= $data['idProduk']?>">
                <?php foreach ($tampilFotoDashboard as $foto):?>
                  <img src="../content/img/product/<?= $foto['fotoProduk']?>" class="card-img-top" />
                <?php endforeach;?>
                <div class="card-body p-0 ps-2 pe-2">
                  <span class="nama"><?= $data['namaProduk']; ?></span>
                  <span class="harga">Rp<?= $harga; ?></span>
                </div>
              </a>
            </div>
      <?php
          endforeach;
        endif; 
      ?>
    </div>
  </div>
</section>
<!-- Newest Section End -->

<!-- Banner Section Start -->
<section class="banner mb-3">
  <div class="d-flex">
    <div class="">
      <span>PUNYA USAHA SENDIRI?</span>
      <h4><strong>DAFTARKAN USAHAMU SEKARANG!</strong></h4>
      <a href="https://wa.link/3n1kwi" target="_blank" class="btn btn-sm btn-prim">DAFTAR</a>
    </div>
    <div class="">
      <img src="../content/img/maskot.png" alt="" srcset="" width="125" />
    </div>
  </div>
</section>
<!-- Banner Section End -->

<!-- Start Section Tas -->
<section class="new-product d-flex flex-column mb-3 p-2">
  <div class="d-flex justify-content-between section-head mt-2">
    <p>Tas</p>
    <a href="?hal=produk&kategori=Tas">Lihat Semua</a>
  </div>
  <div class="">
    <div class="scrolling-wrapper">
      <?php
          if (!empty($tampilTas)):
            foreach ($tampilTas as $dataTas):
              $hargaDiskon = $dataTas['harga'] - ($dataTas['harga'] * $dataTas['diskon'] / 100);
              $harga = number_format($hargaDiskon, 0, ',', '.');
              $tampilFotoDashboard = $produk->tampilFotoDashboard($dataTas['idProduk']);
      ?>
      <div class="card card-product me-2">
        <a href="?hal=produk&id=<?= $dataTas['idProduk']?>">
          <?php foreach ($tampilFotoDashboard as $foto):?>
            <img src="../content/img/product/<?= $foto['fotoProduk']?>" class="card-img-top" />
          <?php endforeach;?>
          <div class="card-body p-0 ps-2 pe-2">
            <span class="nama"><?= $dataTas['namaProduk']; ?></span>
            <span class="harga">Rp<?= $harga; ?></span>
          </div>
        </a>
      </div>
      <?php
          endforeach;
        endif; 
      ?>
    </div>
  </div>
</section>
<!-- End Section Tas -->

<!-- Start Section Pakaian -->
<section class="new-product d-flex flex-column p-2">
  <div class="d-flex justify-content-between section-head mt-2">
    <p>Pakaian</p>
    <a href="?hal=produk&kategori=Pakaian">Lihat Semua</a>
  </div>
  <div class="">
    <div class="scrolling-wrapper">
      <?php
        if (!empty($tampilPakaian)):
          foreach ($tampilPakaian as $dataPakaian):
            $hargaDiskon = $dataPakaian['harga'] - ($dataPakaian['harga'] * $dataPakaian['diskon'] / 100);
            $harga = number_format($hargaDiskon, 0, ',', '.');
            $tampilFotoDashboard = $produk->tampilFotoDashboard($dataPakaian['idProduk']);
      ?>
      <div class="card card-product me-2">
        <a href="?hal=produk&id=<?= $dataPakaian['idProduk']?>">
          <?php foreach ($tampilFotoDashboard as $foto):?>
            <img src="../content/img/product/<?= $foto['fotoProduk']?>" class="card-img-top" />
          <?php endforeach;?>
          <div class="card-body p-0 ps-2 pe-2">
            <span class="nama"><?= $dataPakaian['namaProduk']; ?></span>
            <span class="harga">Rp<?= $harga; ?></span>
          </div>
        </a>              
      </div>
      <?php
          endforeach;
        endif; 
      ?>
    </div>
  </div>
</section>
<!-- End Section Pakaian -->

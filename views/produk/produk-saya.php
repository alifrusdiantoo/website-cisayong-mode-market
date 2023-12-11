    <?php
      include_once '../lib/superadmin.php';
      include_once '../lib/produk.php';

      // instansiasi objek penjual
      $penjual = new penjual();
      $tampilAkun = $penjual->tampilAkun();

      // instansiasi objek produk
      $produk = new produk();
      $tampilProduk = $produk->tampilProdukToko($_GET['id']);
    ?>
    <div class="bg-gray">
      <nav class="d-flex align-items-center p-2 sticky-top">
        <a href="?hal=toko-saya&id=<?= $_GET['id']?>" class="me-3"><i class="bi bi-arrow-left fs-3"></i></a>
        <span>Produk Saya</span>
      </nav>
    </div>

    <?php if (!empty($tampilProduk)): ?>
    <?php foreach ($tampilProduk as $data):
      $harga = $data['harga'];
      $diskon = $data['diskon'];
      $stok = $data['stokProduk'];
      $hargaDiskon = number_format($harga - ($harga * $diskon/100), 0, ",", ".");
      $tampilFotoDashboard = $produk->tampilFotoDashboard($data['idProduk']);
    ?>
      <div class="bg-gray mt-2 p-0">
        <div class="card-kelola-produk row gx-0 align-items-center">
          <div class="col-3">
            <?php foreach ($tampilFotoDashboard as $foto):?>
              <img src="../content/img/product/<?= $foto['fotoProduk'] ?>" alt="Foto Produk" />
            <?php endforeach;?>
          </div>

          <div for="" class="col-5 p-2 d-flex flex-column">
            <span><?= $data['namaProduk']; ?></span>
            <span><?= $hargaDiskon; ?></span>
            <span>Stok: <?= $data['stokProduk']; ?></span>
          </div>

          <div class="col-2 d-flex justify-content-center bg-green h-100">
            <a href="?hal=kelola-produk&aksi=ubah-produk&id=<?= $data['idPenjual']?>&idProduk=<?=$data['idProduk'] ?>" class="text-white">Ubah</a>
          </div>

          <div class="col-2 d-flex justify-content-center">
            <a onclick="alertHapusProduk(<?= $data['idPenjual']?>, <?= $data['idProduk']?>)" class="">Hapus</a>
          </div>
        </div>
      </div>
      <?php endforeach ?>
    <?php endif ?>

    <footer class="tambah-produk fixed-bottom bg-gray text-white p-2">
      <div class="bg-green flex-fill text-center d-flex justify-content-center h-100 fs-12">
        <a href="?hal=kelola-produk&aksi=tambah-produk&id=<?= $_GET['id'] ?>" class="">Tambah Produk</a>
      </div>
    </footer>

    <?php 
      include_once '../lib/produk.php';

      // instansiasi objek produk
      $produk = new produk();
      $tampilProduk = $produk->tampilProduk(@$_GET['kategori']);
      
      if (isset ($_POST['cari'])) {
        $tampilProduk = $produk->cariProduk($_POST);
      }
    ?>
    
    <!-- Start Section List Produk -->
    <section class="section-product mt-4 p-3">
      <form action="" method="POST">
        <div class="input-group mb-3">
          <input type="text" class="form-control fs-12" name="keyword" placeholder="Cari Produk" autocomplete="off"/>
          <button class="btn btn-prim" name="cari" type="submit"><i class="bi bi-search"></i></button>
        </div>
        <div class="d-inline-flex sort-by">
          <select class="form-select me-2" name="sort-by" aria-label="Default select example">
            <option selected value="DESC">Terbaru</option>
            <option value="ASC">Terlama</option>
          </select>
          <select class="form-select" name="kategori" aria-label="Default select example">
            <option selected value="">Semua</option>
            <option value="Pakaian">Pakaian</option>
            <option value="Tas">Tas</option>
          </select>
        </div>
      </form>
      <section class="d-flex flex-wrap justify-content-between mt-3">
      <?php if (!empty($tampilProduk)):
        foreach ($tampilProduk as $data):
          $harga = $data['harga'];
          $diskon = $data['diskon'];
          $hargaDiskon = number_format($harga - ($harga * $diskon/100), 0, ",", ".");
          $tampilFotoDashboard = $produk->tampilFotoDashboard($data['idProduk']);
      ?>
          <div class="card card-product mb-3">
            <a href="?hal=produk&id=<?= $data['idProduk']?>">
              <?php foreach ($tampilFotoDashboard as $foto):?>
              <img src="../content/img/product/<?= $foto['fotoProduk']?>" class="card-img-top" />
              <?php endforeach;?>
              <div class="card-body p-0 ps-2 pe-2">
                <span class="nama"><?= $data['namaProduk']; ?></span>
                <div class="d-flex justify-content-between">
                  <span class="harga">Rp<?= $hargaDiskon; ?></span>
                  <span class="diskon"><?= $diskon != 0 ? "$diskon%" : ""; ?></span>
                </div>
              </div>
            </a>
          </div>
        <?php endforeach ?>
      <?php else: ?>
        <div class="d-flex flex-column justify-content-center align-items-center">
          <i class="bi bi-emoji-frown-fill" style="font-size: 2rem;"></i>
          <span class="">Belum ada produk untuk ditampilkan</span>
        </div>
      <?php endif;?>
        
    <!-- End Section List Produk -->

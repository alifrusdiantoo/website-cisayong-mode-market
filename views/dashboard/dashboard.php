    <?php
      //mengatasi jika user langsung masuk menggunakan link tanpa login
      if(empty($_SESSION['idUser'])) {
          echo "<script>
              alert('Login Terlebih Dahulu !');
              document.location='../index.php';
          </script>";
      }
  
      // Kondisi menentukan pengguna tertentu yang memiliki akses kepada halaman
      if($_SESSION['user'] != 'superadmin') {
        echo "<script>
            alert('Anda tidak punya hak akses ke halaman ini!');
            history.back();
        </script>";
      }

      include_once '../lib/superadmin.php';
      include_once '../lib/produk.php';

      // instansiasi objek penjual
      $penjual = new penjual();
      $tampilAkun = $penjual->tampilAkun();

      // instansiasi objek produk
      $produk = new produk();
      $tampilProduk = $produk->tampilProduk('');

      $jmlProduk = mysqli_fetch_row($produk->hitungTotalProduk());
      $jmlToko = mysqli_fetch_row($penjual->hitungTotalToko());
      $sortByToko = $penjual->cariProdukDashboard();

      if (isset ($_POST['cari'])) {
        $tampilProduk = $produk->cariProdukDashboard($_POST);
      }
    ?>
    <div class="fs-12">
      <section class="bg-gray p-2">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <p class="mb-0">
            Hai,<br /><span><b>Alif Rusdianto</b></span>
          </p>
          <a href="../config/logout.php">
            <i class="bi bi-box-arrow-right ms-auto" style="font-size: 1.5rem"></i>
          </a>
        </div>

        <div class="row g-1 justify-content-between align-items-center mb-3">
          <div class="col">
            <div class="card bg-gray">
              <div class="card-body p-2">
                <span>Produk</span>
                <h2 class="card-title color-green mb-0"><b><?= $jmlProduk[0]; ?></b></h2>
                <span><small class="text-muted">Terdaftar pada website ini</small><span>
              </div>
            </div>
          </div>

          <div class="col">
            <div class="card bg-gray">
              <div class="card-body p-2">
                <span>Toko</span>
                <h2 class="card-title color-green mb-0"><b><?= $jmlToko[0]; ?></b></h2>
                <span><small class="text-muted">Terdaftar pada website ini</small><span>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="p-2">
        <ul class="nav nav-pills mb-3 mt-2" id="pills-tab" role="tablist">
          <li class="nav-item me-2" role="presentation">
            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Produk</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Toko</button>
          </li>
        </ul>
        <div class="tab-content bg-white " id="pills-tabContent">
          <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
            <div class="search-product mb-3">
              <form action="" method="POST">
                <div class="input-group mb-3">
                  <input type="text" class="form-control fs-12" name="keyword" value="" placeholder="Cari Produk" />
                  <button class="btn btn-prim" name="cari" type="submit"><i class="bi bi-search"></i></button>
                </div>
                <div class="d-flex sort-by">
                  <select class="form-select me-2" name="sort-by">
                    <option selected value="DESC">Terbaru</option>
                    <option value="ASC">Terlama</option>
                  </select>
                  <select class="form-select" name="toko">
                    <option selected value="">Semua</option>
                    <?php foreach ($sortByToko as $toko): ?>
                    <option value="<?= $toko['namaToko']; ?>"><?= $toko['namaToko']; ?></option>
                    <?php endforeach; ?>
                  </select>

                  <a href="?hal=dashboard&aksi=tambah-produk" class="btn bg-green text-white ms-auto btn-tambah" style="width: 42px;">+</a>
                </div>
              </form>
            </div>
            <!-- Daftar Produk Toko -->
            <?php if (!empty($tampilProduk)): ?>
              <?php foreach ($tampilProduk as $data):
                  $tampilFotoDashboard = $produk->tampilFotoDashboard($data['idProduk']);
                ?>
                <div class="bg-gray mt-2 p-0 rounded-3">
                  <div class="card-kelola-produk row gx-0">
                    <a href="?hal=produk&id=<?= $data['idProduk']?>" class="col-8 row gx-0">
                      <div class="col-4">
                        <?php foreach ($tampilFotoDashboard as $foto):?>
                          <img src="../content/img/product/<?= $foto['fotoProduk']?>" alt="Foto Produk" />
                        <?php endforeach;?>
                      </div>
                      <div for="" class="col-8 p-2 d-flex flex-column">
                        <span><strong><?= $data["namaProduk"]; ?></strong></span>
                        <span><?= $data["namaToko"]; ?></span>
                        <span>Rp<?= number_format($data["harga"], 0, ",", "."); ?></span>
                        <span class="mt-auto">Stok: <?= $data["stokProduk"]; ?></span>
                      </div>
                    </a>

                    <div class="col-2 d-flex justify-content-center align-items-center bg-green h-100">
                      <object><a href="?hal=dashboard&aksi=ubah-produk&id=<?= $data['idProduk']?>" class="text-white">Ubah</a></object>
                    </div>
            
                    <div class="col-2 d-flex justify-content-center align-items-center h-100">
                      <object><a onclick="alertHapusProduk(<?= $data['idPenjual']?>, <?= $data['idProduk']?>)" class="">Hapus</a></object>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php else: ?>
              <div class="d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-emoji-frown-fill" style="font-size: 2rem;"></i>
                <span class="">Belum ada produk untuk ditampilkan</span>
              </div>
            <?php endif;?>
          </div>

          <!-- Tab Toko -->
          <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
            <!-- Section Search Toko -->
            <div class="search-product mb-3">

              <div class="input-group sort-by">
                <a href="?hal=dashboard&aksi=tambah-toko" class="btn bg-green text-white btn-tambah" style="width: 42px;">+</a>
              </div>

            <?php if (!empty($tampilAkun)): ?>
              <?php foreach ($tampilAkun as $data):?>
                <div class="bg-gray mt-2 p-0 rounded-3">
                  <div class="card-kelola-produk row gx-0 align-items-center">
                    <div class="col-3">
                      <img src="../content/img/profil/<?= $data["fotoProfil"] ?>" alt="Foto Toko" />
                    </div>
            
                    <div for="" class="col-5 p-2 d-flex flex-column">
                      <span><strong><?= $data["namaToko"];?></strong></span>
                      <span><?= $data["namaPenjual"];?></span>
                    </div>
            
                    <div class="col-2 d-flex justify-content-center bg-green h-100">
                      <a href="?hal=dashboard&aksi=ubah-toko&id=<?= $data["idPenjual"] ?>" class="text-white">Ubah</a>
                    </div>
            
                    <div class="col-2 d-flex justify-content-center h-100">
                      <a onclick="alertHapus(<?= $data['idPenjual']?>)" class="">Hapus</a>
                    </div>
                  </div>
                </div>
              <?php endforeach ?>
            <?php else: ?>
              <div class="d-flex flex-column justify-content-center align-items-center">
                <i class="bi bi-emoji-frown-fill" style="font-size: 2rem;"></i>
                <span class="">Belum ada toko yang terdaftar</span>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
    </div>

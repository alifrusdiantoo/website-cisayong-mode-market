    <?php 
      include_once '../lib/superadmin.php';
      include_once '../lib/produk.php';

      $produk = new produk();
      // instansiasi objek penjual
      $penjual = new penjual();
      $tampilAkun = $penjual->tampilAkun();
    ?>
    <!-- Start Section List Produk -->
    <section class="section-toko mt-4 p-3">
      <div class="d-flex flex-column justify-content-between mt-3">
        <h6 class="mb-3"><strong>Toko Terdaftar</strong></h6>
        <?php if(!empty($tampilAkun)):
            foreach ($tampilAkun as $data):
              $jmlProduk = implode($produk->hitungProduk($data['idPenjual']));
        ?>
            <div class="card card-toko mb-3">
              <div class="card-body d-flex align-items-center p-2">
                <img src="../content/img/profil/<?= $data['fotoProfil']?>" alt="" width="40" height="40" class="me-2" />
                <div class="nama">
                  <span><?= $data['namaToko']; ?></span>
                  <br />
                  <span><span class="jml-product"><?= $jmlProduk; ?></span> Produk</span>
                </div>
                <a href="?hal=toko&id=<?= $data['idPenjual'] ?>" class="btn btn-visit ms-auto">Kunjungi</a>
              </div>
            </div>
          <?php endforeach;
        endif; ?>
      </div>
    </section>
    <!-- End Section List Produk -->

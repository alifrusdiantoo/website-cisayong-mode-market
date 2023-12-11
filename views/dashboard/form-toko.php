    <?php
      include '../lib/superadmin.php';
      // inisialisasi objek
      $penjual = new penjual();

      // Mendapatkan Data Akun Dari Database Untuk otomatisasi isi form edit
      if(isset($_GET['aksi'])){
        if($_GET['aksi'] == 'ubah-toko'){
          if(isset($_GET['id'])){
            // Ambil id toko yang akan diubah
            $id = $_GET['id'];
    
            $getDataAkun = $penjual->getDataAkun($id);
            $getDataToko = $penjual->getDataToko($id);
    
            if (mysqli_num_rows($getDataAkun) == 1 && mysqli_num_rows($getDataToko) == 1) {
                // Ambil data toko
                $dataToko = mysqli_fetch_assoc($getDataToko);
                $namaToko = $dataToko['namaToko'];
    
                $dataAkun = mysqli_fetch_assoc($getDataAkun);
                $namaPenjual = $dataAkun['namaPenjual'];
                $telepon = $dataAkun['telepon'];
                $username = $dataAkun['username'];
                $password = $dataAkun['password'];
            } else {
                echo "<script>alert('Data Tidak Ditemukan.');</script>";
            }
          }
        } else if($_GET['aksi'] == 'hapus-toko'){
          if(isset($_GET['id'])){
            $idPenjual = $_GET['id'];
            $hapusAkun = $penjual->hapusAkun($idPenjual);
          }
        }
      }

      // Cek kondisi akan edit data atau tambah data
      if(isset ($_POST['submit'])) {
        if($_GET['aksi'] == 'ubah-toko'){
          $editStok = $penjual->editAkun($_POST, $id);
        } else {
          $tambahStok = $penjual->tambahAkun($_POST);
        }
      }
    ?>

    <form action="" method="post" id="form-produk" class="form-produk">
      <div class="bg-gray m-0 sticky-top">
        <nav class="d-flex align-items-center p-2">
          <a onclick="history.back()" class="me-3"><i class="bi bi-arrow-left fs-3"></i></a>
          <span>Tambah Toko</span>
          <button type="submit" name="submit" class="btn bg-green text-white ms-auto">Simpan</button>
        </nav>
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="namaToko">Nama Toko</label>
        <hr />
        <input type="text" placeholder="Masukkan nama toko" name="namaToko" id="namaToko" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $namaToko ?>" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="namaPenjual">Pemilik Toko</label>
        <hr />
        <input type="text" placeholder="Masukkan nama pemilik toko" name="namaPenjual" id="namaPenjual" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $namaPenjual ?>" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="telepon">Kontak</label>
        <hr />
        <input type="tel" placeholder="Masukkan kontak toko" name="telepon" id="telepon" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $telepon ?>" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="username">Username</label>
        <hr />
        <input type="text" placeholder="Masukkan username" name="username" id="username" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $username ?>" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="password">Password</label>
        <hr />
        <input type="text" placeholder="Masukkan password" name="password" id="password" class="form-control bg-gray border-0 ps-0 pe-0" value="<?=@ $password ?>" required />
      </div>
    </form>

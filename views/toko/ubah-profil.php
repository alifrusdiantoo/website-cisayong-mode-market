    <?php
      include '../lib/superadmin.php';

      // inisialisasi objek
      $penjual = new penjual();

      // Mendapatkan Data Akun Dari Database Untuk otomatisasi isi form edit
      if(isset($_GET['id'])){

        $idPenjual = $_GET['id'];
        $getDataAkun = $penjual->getDataAkun($idPenjual);
        $getDataToko = $penjual->getDataToko($idPenjual);
        if (mysqli_num_rows($getDataAkun) == 1 && mysqli_num_rows($getDataToko) == 1) {
            // Data Akun Penjual
            $dataAkun = mysqli_fetch_assoc($getDataAkun);
            $namaPenjual = $dataAkun['namaPenjual'];
            $telepon = $dataAkun['telepon'];

            // Data Toko Penjual
            $dataToko = mysqli_fetch_assoc($getDataToko);
            $fotoProfil = $dataToko['fotoProfil'];
            $namaToko = $dataToko['namaToko'];
            $deskripsiToko = $dataToko['deskripsiToko'];
            $alamatToko = $dataToko['alamatToko'];
        } else {
            echo "<script>alert('Data Tidak Ditemukan.');</script>";;
        }
      }

      // Update data baru kedalam database
      if(isset ($_POST['submit'])) {
        $penjual->ubahProfil($_POST, $idPenjual, $fotoProfil);
      }

      // notif berhasil ubah data
      if (isset($_GET['success'])) {
        echo "<script>alert('Data Berhasil Diperbarui.');</script>";
      }
    ?>

    <form action="" method="POST" enctype="multipart/form-data" class="form-ubah-profil">

      <div class="bg-gray m-0">
        <nav class="d-flex align-items-center p-2">
          <a onclick="history.back()" class="me-3"><i class="bi bi-arrow-left fs-3"></i></a>
          <span>Ubah Profil Toko</span>
          <button type="submit" name="submit" value="Simpan" class="btn bg-green text-white ms-auto">Simpan</button>
        </nav>
      </div>

      <div class="input-foto bg-gray mt-2 p-2">
        <div class="d-flex justify-content-between align-items-center">
          <label for="">Foto Profil Toko</label>
          <img src="../content/img/profil/<?= $fotoProfil?>" onclick="pilihFoto()" alt="foto profil usaha" id="tampilFoto" width="45" height="45" />
          <input type="file" name="fotoProfil" accept=".png, .jpeg, .jpg" onchange="displayImage(this)" id="fotoProfil" class="d-none" />
        </div>
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="namaToko">Nama Toko</label>
        <hr />
        <input type="text" placeholder="Masukkan nama toko" name="namaToko" id="namaToko" value="<?= $namaToko?>" class="form-control bg-gray border-0 ps-0 pe-0" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <div class="d-flex justify-content-between">
          <label for="deskripsiToko">Deskripsi Toko</label>
          <span><span id="hitung">0</span>/500</span>
        </div>
        <hr />
        <textarea class="form-control bg-gray border-0 ps-0 pe-0" name="deskripsiToko" id="deskripsiToko" placeholder="Masukkan deskripsi toko" maxlength="500" rows="3" onkeyup="hitungKarakter(this.value)" required><?= $deskripsiToko?></textarea>
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="alamatToko">Alamat Toko</label>
        <hr />
        <input type="text" placeholder="Masukkan alamat toko" name="alamatToko" id="alamatToko" class="form-control bg-gray border-0 ps-0 pe-0" value="<?= $alamatToko?>" autocomplete="off" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="namaPenjual">Pemilik Toko</label>
        <hr />
        <input type="text" placeholder="Masukkan nama pemilik toko" name="namaPenjual" id="namaPenjual" class="form-control bg-gray border-0 ps-0 pe-0" value="<?= $namaPenjual?>" required />
      </div>

      <div class="bg-gray mt-2 p-2">
        <label for="telepon">Kontak</label>
        <hr />
        <input type="number" placeholder="Masukkan kontak toko" name="telepon" id="telepon" class="form-control bg-gray border-0 ps-0 pe-0" value="<?= $telepon?>" required />
      </div>
    </form>

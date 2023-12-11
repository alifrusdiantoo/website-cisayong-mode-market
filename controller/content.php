<?php 
  // Kelola konten yang ditampilkan
  @$halaman = $_GET['hal'];

  if ($halaman == 'beranda' || $halaman == '')
  {
    include '../views/landing-page/landing-page.php';
  }
  else if ($halaman == 'produk')
  {
    if(@$_GET['id'] != '')
    {
      include '../views/produk/info-produk.php';
    }
    else{
      include '../views/produk/produk.php';
    }
  }
  else if ($halaman == 'toko')
  {
    if(@$_GET['id'] != '')
    {
      include '../views/toko/info-toko.php';
    }
    else
    {
      include '../views/toko/toko.php';
    }
  }
  else if($halaman == 'kelola-produk' && @$_GET['id'] != '')
  {
    if(@$_GET['aksi'] == 'tambah-produk' || @$_GET['aksi'] == 'ubah-produk' || @$_GET['aksi'] == 'hapus-produk')
    {
      include '../views/produk/form-produk.php';
    }
    else
    {
      include '../views/produk/produk-saya.php';
    }
  }
  else if ($halaman == 'toko-saya')
  {
    if(@$_GET['aksi'] == 'ubah-profil')
    {
      include '../views/toko/ubah-profil.php';
    } else {
      include '../views/toko/toko-saya.php';
    }
  }
  else if ($halaman == 'dashboard')
  {
    if(@$_GET['aksi'] == 'tambah-produk' || @$_GET['aksi'] == 'ubah-produk' || @$_GET['aksi'] == 'hapus-produk')
    {
      include '../views/dashboard/form-produk.php';
    }
    else if (@$_GET['aksi'] == 'tambah-toko' || @$_GET['aksi'] == 'ubah-toko' || @$_GET['aksi'] == 'hapus-toko')
    {
      include '../views/dashboard/form-toko.php';
    }
    else
    {
      include '../views/dashboard/dashboard.php';
    }
  }
  else if ($halaman == 'produk')
  {
    if(@$_GET['id'] != '')
    {
      include '../views/produk/info-produk.php';
    }
  }
  else
  {
  echo "<script>
    alert ('Maaf, Anda tidak memiliki akses ke halaman ini.');
    history.back();
  </script>";
  }

?>
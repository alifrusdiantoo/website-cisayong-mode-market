<?php 
  session_start();
  include 'koneksi.php';
  $koneksi = new database();


  @$username = mysqli_escape_string($koneksi->koneksi, $_POST['username']);
  @$password = mysqli_escape_string($koneksi->koneksi, $_POST['password']);

  // Cek apakah akun terdaftar sebagai superadmin
  $login = mysqli_query($koneksi->koneksi, "SELECT * FROM super_admin WHERE `username`='$username' AND `password`= '$password' ");
  $data = mysqli_fetch_array($login);

  if($data) {
    $_SESSION['idUser'] = $data['idSA'];
    $_SESSION['user'] = 'superadmin';
    echo "<script>
        alert('Login berhasil. Selamat datang!');
        document.location = '../controller/superadmin.php?hal=dashboard';
    </script>";
  }
  else {
    // Cek apakah akun terdaftar sebagai penjual
    $login = mysqli_query($koneksi->koneksi, "SELECT * FROM akun_penjual WHERE `username`='$username' AND `password`= '$password' ");
    $data = mysqli_fetch_array($login);

    if($data){
        $_SESSION['idUser'] = $data['idPenjual'];
        $_SESSION['user'] = 'penjual';
        echo "<script>
            alert('Login berhasil. Selamat datang!');
            document.location = '../controller/menu.php';
        </script>";
    } else {
        echo "<script>
            alert('Username atau Password Salah!');
            document.location='../index.php';
        </script>";
    }
  }
?>
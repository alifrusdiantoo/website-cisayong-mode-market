<?php 
  session_start();
  unset($_SESSION['idUser']);
  unset($_SESSION['user']);

  session_destroy();
  echo "<script>
      alert('Logout Berhasil !');
      document.location='../index.php';
      </script>";
?>
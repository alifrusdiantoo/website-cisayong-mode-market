<?php 
  session_start();

  function activeNavbar($hal){
    $halaman = $_GET['hal'];
    return $halaman == $hal ? 'active': '';
  }

  function cekUser(){
    if(!empty($_SESSION['user'])){
      return $_SESSION['user'] != 'penjual' ? 'd-none' : '';
    } else{
      return 'd-none';
    }
  }

  function cekSuperadmin(){
    if(!empty($_SESSION['user'])){
      return $_SESSION['user'] == 'superadmin' ? 'd-none' : '';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet" />

    <!-- CSS -->
    <link rel="stylesheet" href="../content/css/style.css" />

    <title>Cisayong Mode Market</title>
  </head>
  <body>

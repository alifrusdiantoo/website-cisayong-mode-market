    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
      <div class="container-fluid">
        <a class="navbar-brand" href="?hal=beranda">
          <img src="../content/img/logo.png" alt="" width="30" height="24" />
        </a>
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
          <i class="bi bi-list text-white"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
          <div class="navbar-nav">
            <a class="nav-link <?=@ activeNavbar('beranda')?>" aria-current="page" href="?hal=beranda">Beranda</a>
            <a class="nav-link <?=@ activeNavbar('produk')?>" href="?hal=produk">Produk</a>
            <a class="nav-link <?=@ activeNavbar('toko')?>" href="?hal=toko">Toko</a>
            <a class="nav-link <?=@ activeNavbar('toko-saya')?> <?=@ cekUser() ?>" href="?hal=toko-saya&id=<?=@ $_SESSION['idUser'] ?>">Toko Saya</a>
            <a class="nav-link <?=@ empty($_SESSION['user']) ? '' : 'd-none' ?>" href="../index.php">Login</a>
            <a class="nav-link <?=@ cekUser() ?>" href="../config/logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>
    <!-- Navbar end -->
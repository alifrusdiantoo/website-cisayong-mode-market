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
    <link rel="stylesheet" href="content/css/style.css" />

    <style>
      body {
        background: url(content/img/background.png);
        background-size: cover;
      }
    </style>

    <title>Login | Cisayong Mode Market</title>
  </head>
  <body>
    <section class="vh-100">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem">
              <div class="card-body p-3">
                <h2 class="text-center mt-4 mb-5"><strong>LOGIN</strong></h2>
                <form action="config/cek_login.php" method="POST" class="fs-12">
                  <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan Username" aria-describedby="username" autocomplete="off" required />
                  </div>
                  <div class="mb-3">
                    <label for="" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required />
                  </div>
                  <div class="mb-5">
                    <input class="form-check-input" type="checkbox" value="" id="tampilPassword" />
                    <label class="form-text form-check-label" for="flexCheckDefault"> Tampilkan Password </label>
                  </div>
                  <button type="submit" class="btn btn-prim w-100 mb-2 fs-12">Login</button>
                  <a href="controller/menu.php?hal=beranda" class="btn bg-gray w-100 mb-3 fs-12">Masuk Sebagai Pembeli</a>

                  <div id="loginHelp" class="form-text text-center mb-4">
                    Mengalami masalah? <a href="" class="text-decoration-none"><strong>Hubungi Pengembang</strong></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <script src="scripts/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

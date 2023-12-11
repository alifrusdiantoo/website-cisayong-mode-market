<?php
    include_once '../config/koneksi.php';

    class produk {
        protected $idProduk;
        protected $namaProduk;
        protected $harga;
        protected $kategori;
        protected $deskripsi;
        protected $diskon;
        protected $variasi;
        protected $ukuran;
        protected $stok;
        protected $image;
        public $db;

        public function __construct() {
            $this->db = new database();
        }

        public function tampilProduk($kategori) {
            if($kategori != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND produk.kategori = '$kategori' ORDER BY produk.idProduk DESC;";

                $result = mysqli_query($this->db->koneksi, $query);
            } else {
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk ORDER BY produk.idProduk DESC;";

                $result = mysqli_query($this->db->koneksi, $query);
            }

            $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($dataProduk) {
                return $dataProduk;
            }
        }

        public function tampilFotoProduk($idProduk) {
        
            $query = "SELECT * FROM foto WHERE foto.idProduk = $idProduk";
    
            $result = mysqli_query($this->db->koneksi, $query);
            $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($dataProduk) {
                return $dataProduk; 
            }
        }
    
        public function tampilFotoDashboard($idProduk) {
            $query = "SELECT foto.fotoProduk FROM foto  WHERE foto.idProduk = $idProduk ORDER BY idFoto ASC LIMIT 1";
            $result = mysqli_query($this->db->koneksi, $query);
    
            $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($dataProduk) {
                return $dataProduk; 
            }
        }

        public function tampilProdukBeranda($kategori) {
            if($kategori != ''){
                $query = "SELECT * FROM produk WHERE produk.kategori = '$kategori' ORDER BY idProduk DESC LIMIT 5;";
            } else {
                $query = "SELECT * FROM produk ORDER BY idProduk DESC LIMIT 5;";
            }

            $result = mysqli_query($this->db->koneksi, $query);
            $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($dataProduk) {
                return $dataProduk;
            }
        }

        public function tampilProdukToko($idPenjual) {
            $query = "SELECT * FROM produk, stok WHERE produk.idPenjual = $idPenjual AND stok.idProduk = produk.idProduk ORDER BY produk.idProduk DESC";

            $result = mysqli_query($this->db->koneksi, $query);
            if ($result) {
                return $result;
            }
        }

        public function getDataProduk($id) {
            $query = "SELECT produk.*, toko_penjual.*, akun_penjual.telepon, stok.stokProduk, ukuran.*, variasi.*, foto.* FROM ((((((produk INNER JOIN stok ON produk.idProduk = stok.idProduk) INNER JOIN ukuran ON produk.idProduk = ukuran.idProduk) INNER JOIN toko_penjual ON produk.idPenjual = toko_penjual.idPenjual)INNER JOIN akun_penjual ON produk.idPenjual = akun_penjual.idPenjual)INNER JOIN variasi ON produk.idProduk = variasi.idProduk) INNER JOIN foto ON foto.idProduk = produk.idProduk) WHERE produk.idProduk = $id AND ukuran.idProduk = $id AND variasi.idProduk = $id";

            $result = mysqli_query($this->db->koneksi, $query);
            if ($result) {
                return $result;
            }
        }

        public function hapusProduk($idPenjual, $idProduk) {
            $query = "DELETE FROM produk WHERE produk.idPenjual = $idPenjual AND produk.idProduk = $idProduk";

            $result = mysqli_query($this->db->koneksi, $query);
            if ($result) {
                echo "<script>
                alert('Data Berhasil Dihapus.');
                history.back();
                </script>";
            }
        }

        public function hitungProduk($idToko) {
            $query = "SELECT COUNT(idProduk) FROM produk WHERE idPenjual = $idToko";

            $result = mysqli_query($this->db->koneksi, $query);
            $jmlProduk = mysqli_fetch_assoc($result);
            if ($jmlProduk) {
                return $jmlProduk;
            }
        }

        public function hitungTotalProduk(){
            $query = "SELECT COUNT(idProduk) FROM produk";

            $result = mysqli_query($this->db->koneksi, $query);
            if ($result) {
                return $result;
            }
        }

        public function tampilUkuran($idProduk){
            $query = "SELECT ukuranProduk FROM ukuran WHERE idProduk = $idProduk";

            $result = mysqli_query($this->db->koneksi, $query);
            $dataProduk = mysqli_fetch_all($result, MYSQLI_ASSOC);
            if ($dataProduk) {
                return $dataProduk;
            }
        }

        public function cariProduk($produkCari){
            $sortBy = $produkCari['sort-by'];
            $kategori = $produkCari['kategori'];
            $keyword = $produkCari['keyword'];
            if($sortBy != '' && $kategori != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND produk.namaProduk LIKE '%$keyword%' AND produk.kategori LIKE '%$kategori%' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            } else if ($sortBy != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND produk.namaProduk LIKE '%$keyword%' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            }else if ($kategori != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND produk.kategori LIKE '%$kategori%' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            } else {
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            }
            return $tampil;
        }

        public function cariProdukDashboard($produkCari){
            $keyword = $produkCari['keyword'];
            $sortBy = $produkCari['sort-by'];
            $toko = $produkCari['toko'];

            if($toko != '' && $keyword != '') {
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND toko_penjual.namaToko = '$toko' AND produk.namaProduk LIKE '%$keyword%' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            } else if ($toko != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND toko_penjual.namaToko = '$toko' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            } else if ($keyword != ''){
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk AND produk.namaProduk LIKE '%$keyword%' ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            } else {
                $query = "SELECT * FROM produk, toko_penjual, stok WHERE toko_penjual.idPenjual = produk.idPenjual AND stok.idProduk = produk.idProduk ORDER BY produk.idProduk $sortBy";

                $tampil = mysqli_query($this->db->koneksi, $query);
            }
            return $tampil;
        }

        public function tambahProduk($data, $idPenjual) {
            $this->namaProduk = $data['namaProduk'];
            $this->harga = $data['hargaProduk'];
            $this->kategori = $data['kategoriProduk'];
            $this->deskripsi = $data['deskripsiProduk'];
            $this->diskon = $data['diskonProduk'];
            $this->ukuran = $data['ukuranProduk'];
            $this->variasi = $data['variasiProduk'];
            $this->stok = $data['stokProduk'];
            $this->image = $_FILES['fotoProduk'];
    
            // Insert Data produk ke tabel produk
            $queryProduk = "INSERT INTO `produk` (`idProduk`, `idPenjual`,`namaProduk`, `harga`, `kategori`, `deskripsi`, `diskon`) VALUES ('', '$idPenjual','$this->namaProduk', '$this->harga', '$this->kategori', '$this->deskripsi', '$this->diskon')";
            $resultProduk = mysqli_query($this->db->koneksi, $queryProduk);
    
            // mengambil idProduk untuk di insert ke tabel lain
            $this->idProduk = mysqli_insert_id($this->db->koneksi);
    
            // Insert ke tabel ukuran
            
            $queryUkuran = "INSERT INTO `ukuran` (`idUkuran`, `idProduk`, `ukuranProduk`) VALUES ('', '$this->idProduk', '$this->ukuran')";
            $resultUkuran = mysqli_query($this->db->koneksi, $queryUkuran);
    
            // insert ke tabel variasi
            $queryWarna = "INSERT INTO `variasi` (`idVariasi`, `idProduk`, `variasiProduk`) VALUES ('', '$this->idProduk', '$this->variasi')";
            $resultWarna = mysqli_query($this->db->koneksi, $queryWarna);
    
            // insert ke tabel stok
            $queryStok = "INSERT INTO `stok` (`idStok`, `idProduk`, `stokProduk`) VALUES ('', '$this->idProduk', '$this->stok')";
            $resultStok = mysqli_query($this->db->koneksi, $queryStok);
    
            // foto
            $number_image = count($this->image['name']);
            for ($i=0; $i < $number_image; $i++) { 
                // Mendapatkan info image dan simpan dalam variabel
                $image_name = $this->image['name'][$i];
                $tmp_name = $this->image['tmp_name'][$i];
                $error = $this->image['error'][$i];
                
                // jika tidak terjadi error selama upload
                if ($error === 0) {
                    // dapatkan ekstensi image dan simpan dalam var
                    $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                    // convert ekstensi ke lower case dan simpan dalam var
                    $img_extension_lc = strtolower($img_extension);
                    // membuat array yang menyimpan ekstensi image yang diizinkan
                    $allow_extension = array('jpg', 'jpeg', 'png');
    
                    // cek jika extension image tersedia dalam array $allow_extension
                    if (in_array($img_extension_lc, $allow_extension)) {
                        // rename image
                        $new_img_name = uniqid('IMG-', true).'.'.$img_extension_lc;
    
                        $img_upload_path = '../content/img/product/'.$new_img_name;
    
                        // insert image ke database
                        $queryImage = "INSERT INTO foto (`idProduk`,`fotoProduk`) VALUES ('$this->idProduk', '$new_img_name')";
    
                        $resultImage = mysqli_query($this->db->koneksi, $queryImage);
    
                        move_uploaded_file($tmp_name, $img_upload_path);
                    }else {
                        echo "<script>
                        alert('Anda tidak dapat mengupload jenis file ini');
                        document.location = '?hal=kelola-produk&id=$idPenjual';
                        </script>";
                    }
                }else {
                    echo "<script>
                    alert('Error Tidak Dikenal Terjadi Selama Proses Upload');
                    document.location = '?hal=kelola-produk&id=$idPenjual';
                    </script>";
                }
            }
            // checking apakah sql insert sudah berhasil
            if ($resultProduk && $resultUkuran && $resultWarna && $resultStok && $resultImage) {
                echo "<script>
                alert('Produk berhasil ditambahkan.');
                history.back();
                </script>";
            } else {
                echo "<script>
                alert('Gagal menambahkan data. Silakan coba lagi.');
                document.location = '?hal=kelola-produk&id=$idPenjual';
                </script>";
            }
        }

        public function editProduk($data, $idProduk, $fotoProduk){
            $this->namaProduk = $data['namaProduk'];
            $this->deskripsi = $data['deskripsiProduk'];
            $this->harga = $data['hargaProduk'];
            $this->diskon = $data['diskonProduk'];
            $this->kategori = $data['kategoriProduk'];
            $this->variasi = $data['variasiProduk'];
            $this->ukuran = $data['ukuranProduk'];
            $this->stok = $data['stokProduk'];
            $this->image = $_FILES['fotoProduk'];
            
            $number_image = count($this->image['name']);
            for ($i=0; $i < $number_image; $i++) { 
                // Mendapatkan info image dan simpan dalam variabel
                $image_name = $this->image['name'][$i];
                $tmp_name = $this->image['tmp_name'][$i];
                $error = $this->image['error'][$i];
            }
            
            if ($error === 4) {
                $query = "UPDATE produk, variasi, ukuran, stok, foto SET
                produk.namaProduk = '$this->namaProduk', produk.deskripsi = '$this->deskripsi', produk.harga = '$this->harga', produk.diskon = '$this->diskon', produk.kategori = '$this->kategori', variasi.variasiProduk = '$this->variasi', ukuran.ukuranProduk = '$this->ukuran', stok.stokProduk = '$this->stok' WHERE produk.idProduk = '$idProduk' AND variasi.idProduk = '$idProduk' AND ukuran.idProduk ='$idProduk' AND stok.idProduk = '$idProduk'";
                
                $result = mysqli_query($this->db->koneksi, $query);
            }else {
                $query = "DELETE FROM foto WHERE foto.idProduk = '$idProduk'";
                $result = mysqli_query($this->db->koneksi, $query);

                $query = "UPDATE produk, variasi, ukuran, stok SET
                produk.namaProduk = '$this->namaProduk', produk.deskripsi = '$this->deskripsi', produk.harga = '$this->harga', produk.diskon = '$this->diskon', produk.kategori = '$this->kategori', variasi.variasiProduk = '$this->variasi', ukuran.ukuranProduk = '$this->ukuran', stok.stokProduk = '$this->stok'  WHERE produk.idProduk = '$idProduk' AND variasi.idProduk = '$idProduk' AND ukuran.idProduk ='$idProduk' AND stok.idProduk = '$idProduk'";

                $result = mysqli_query($this->db->koneksi, $query);
                for ($i=0; $i < $number_image; $i++) { 
                    // Mendapatkan info image dan simpan dalam variabel
                    $image_name = $this->image['name'][$i];
                    $tmp_name = $this->image['tmp_name'][$i];
                    if ($error === 0) {
                        // dapatkan ekstensi image dan simpan dalam var
                        $img_extension = pathinfo($image_name, PATHINFO_EXTENSION);
                        // convert ekstensi ke lower case dan simpan dalam var
                        $img_extension_lc = strtolower($img_extension);
                        // membuat array yang menyimpan ekstensi image yang diizinkan
                        $allow_extension = array('jpg', 'jpeg', 'png');
        
                        // cek jika extension image tersedia dalam array $allow_extension
                        if (in_array($img_extension_lc, $allow_extension)) {
                            // rename image
                            $new_img_name = uniqid('IMG-', true).'.'.$img_extension_lc;
        
                            $img_upload_path = '../content/img/product/'.$new_img_name;
        
                            // insert image ke database
                            $query = "INSERT INTO foto (idProduk, fotoProduk) VALUES ('$idProduk', '$new_img_name')";
                            $result = mysqli_query($this->db->koneksi, $query);
                            
                            move_uploaded_file($tmp_name, $img_upload_path);

                        }else {
                            echo "<script>
                            alert('Anda tidak dapat mengupload jenis file ini');
                            history.back();
                            </script>";
                        }
                    }else {
                        echo "<script>
                        alert('Error Tidak Dikenal Terjadi Selama Proses Upload');
                        history.back();                     
                        </script>";
                    }
                }
            }
            
            if ($result) {
                echo "<script>
                alert('Data Berhasil Diperbarui.');
                history.go(-2);
                </script>";
            }else{
                echo "<script>alert('Gagal memperbarui data');
                history.go(-2);
                </script>";
            }
        }
    }
?>
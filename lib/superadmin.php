<?php
// menghubungkan dengan file koneksi.php
include_once "../config/koneksi.php";

// class super admin
class superAdmin {
    protected $username;
    protected $password;
    protected $db;

    public function __construct()
    {
        $this->db = new database();
    }
}

class penjual extends superAdmin {
    private $idPenjual;
    private $namaPenjual;
    private $namaToko;
    private $telepon;
    private $alamatToko;
    private $deskripsiToko;
    private $fotoProfil;

    public function tambahAkun($data) {
        $this->namaPenjual = $data['namaPenjual'];
        $this->namaToko = $data['namaToko'];
        $this->telepon = $data['telepon'];
        $this->username = $data['username'];
        $this->password = $data['password'];

        $queryAkun = "INSERT INTO akun_penjual (`idPenjual`, `namaPenjual`, `telepon`, `username`, `password`) VALUES ('', '$this->namaPenjual', '$this->telepon','$this->username', '$this->password')";
        $resultAkun = mysqli_query($this->db->koneksi, $queryAkun);
        
        $this->idPenjual = mysqli_insert_id($this->db->koneksi);

        $queryToko = "INSERT INTO `toko_penjual` (`idPenjual`, `namaToko`, `fotoProfil`) VALUES ('$this->idPenjual', '$this->namaToko', 'default.png')";
        $resultToko = mysqli_query($this->db->koneksi, $queryToko);
        if ($resultAkun && $resultToko) {
            echo "<script>
            alert('Data berhasil ditambahkan.');
            document.location='?hal=dashboard';
            </script>";
        } else {
            echo "<script>
            alert('Data gagal ditambahkan.');
            document.location='?hal=dashboard';
            </script>";
        }
    }

    public function tampilAkun() {
        $query = "SELECT akun_penjual.*, toko_penjual.* FROM (akun_penjual INNER JOIN toko_penjual ON akun_penjual.idPenjual = toko_penjual.idPenjual)";

        $result = mysqli_query($this->db->koneksi, $query);
        $akun = mysqli_fetch_all($result, MYSQLI_ASSOC);
        if ($akun) {
            return $akun;
        }
    }

    public function getDataAkun($idPenjual) {
        $query = "SELECT * FROM akun_penjual WHERE `idPenjual` = '$idPenjual'";
        $result = mysqli_query($this->db->koneksi, $query);
        
        if ($result) {
            return $result;
        }
    }

    public function getDataToko($idPenjual) {
        $query = "SELECT * FROM toko_penjual WHERE `idPenjual` = '$idPenjual'";
        $result = mysqli_query($this->db->koneksi, $query);

        if ($result) {
            return $result;
        }
    }

    public function hitungTotalToko(){
        $query = "SELECT COUNT(idToko) FROM toko_penjual";
        
        $result = mysqli_query($this->db->koneksi, $query);
        if ($result) {
            return $result;
        }
    }

    public function editAkun($data, $idPenjual) {
        $this->namaPenjual = $data['namaPenjual'];
        $this->namaToko = $data['namaToko'];
        $this->telepon = $data['telepon'];
        $this->username = $data['username'];
        $this->password = $data['password'];

        $query = "UPDATE akun_penjual, toko_penjual 
        SET akun_penjual.namaPenjual = '$this->namaPenjual',
        toko_penjual.namaToko = '$this->namaToko',
        akun_penjual.username = '$this->username',
        akun_penjual.password = '$this->password'
        WHERE akun_penjual.idPenjual = '$idPenjual' AND toko_penjual.idPenjual = '$idPenjual'";
        
        $result = mysqli_query($this->db->koneksi, $query);
        
        if ($result) {
          echo "<script>
                alert('Data Berhasil Diperbarui.');
                document.location='?hal=dashboard';
                </script>";
        } else {
          echo "<script>
                alert('Gagal memperbarui data');
                document.location='?hal=dashboard';
                </script>";
        }
    }

    public function hapusAkun($idPenjual) {
        $query = "DELETE FROM akun_penjual WHERE `idPenjual` = '$idPenjual'";

        $result = mysqli_query($this->db->koneksi, $query);
        if ($result) {
            echo "<script>
            alert('Data Berhasil Dihapus.');
            document.location='?hal=dashboard';
            </script>";
        } else {
            echo "<script>
            alert('Data Gagal Dihapus.');
            document.location='?hal=dashboard';
            </script>";
        }
    }

    public function ubahProfil($data, $idPenjual, $fotoProfil) {
        $this->namaPenjual = $data['namaPenjual'];
        $this->namaToko = $data['namaToko'];
        $this->telepon = $data['telepon'];
        $this->deskripsiToko = $data['deskripsiToko'];
        $this->alamatToko = $data['alamatToko'];
        $this->fotoProfil = $_FILES['fotoProfil']['name'];

        // Upload foto
        $error = $_FILES['fotoProfil']['error'];
        $img_name = $_FILES['fotoProfil']['name'];
        $img_size = $_FILES['fotoProfil']['size'];
        $tmp_name = $_FILES['fotoProfil']['tmp_name'];

    
        if ($error === 0) {
            if ($img_size > 2200000) {
                $em = "Tidak Dapat Mengupload Foto Lebih Dari 2MB";
                echo "<script>
                alert('$em');
                document.location = '?hal=toko-saya&id=$idPenjual';
                </script>";
            } else {
                $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
                $img_ext_lc = strtolower($img_ext);
                $allowed_ext = array("jpg", "jpeg", "png");

                if (in_array($img_ext_lc, $allowed_ext)) {
                    $this->fotoProfil = uniqid("IMG-", true). '.' .$img_ext_lc;
                    $img_upload_path = '../content/img/profil/'.$this->fotoProfil;
                    move_uploaded_file($tmp_name, $img_upload_path);

                    // insert ke database
                    $queryToko = "UPDATE `toko_penjual` SET `fotoProfil` = '$this->fotoProfil', `namaToko` = '$this->namaToko', `deskripsiToko` = '$this->deskripsiToko', `alamatToko` = '$this->alamatToko' WHERE idPenjual = '$idPenjual'";
                    $resultToko = mysqli_query($this->db->koneksi, $queryToko);
                    
                } else {
                    $em = "Tidak dapat mengupload jenis file ini!";
                    echo "<script>
                    alert('$em');
                    document.location = '?hal=toko-saya&id=$idPenjual';
                    </script>";
                }
            }
        } else if($error === 4){
            // insert ke database
            $queryToko = "UPDATE `toko_penjual` SET `fotoProfil` = '$fotoProfil', `namaToko` = '$this->namaToko', `deskripsiToko` = '$this->deskripsiToko', `alamatToko` = '$this->alamatToko' WHERE idPenjual = '$idPenjual'";
            $resultToko = mysqli_query($this->db->koneksi, $queryToko);
        } else {
            $em = "Terjadi Error Saat Upload Foto!";
            echo "<script>
            alert('$em');
            document.location = '?hal=toko-saya&id=$idPenjual';
            </script>";
        }

        // update tabel akun_penjual
        $queryAkun = "UPDATE `akun_penjual` SET `namaPenjual` = '$this->namaPenjual', `telepon` = '$this->telepon' WHERE `idPenjual` = '$idPenjual'";
        $resultAkun = mysqli_query($this->db->koneksi, $queryAkun);

        if ($resultAkun && $resultToko) {
            echo "<script>
            alert('Data berhasil diperbarui.');
            document.location = '?hal=toko-saya&id=$idPenjual';
            </script>";
        }else{
            echo "<script>
            alert('Data gagal diperbarui.');
            document.location = '?hal=toko-saya&id=$idPenjual';
            </script>";
        }
    }

    public function cariProdukDashboard(){
        $query = "SELECT idPenjual, namaToko FROM toko_penjual";

        $hasil = mysqli_query($this->db->koneksi, $query);
        $tampil = mysqli_fetch_all($hasil, MYSQLI_ASSOC);

        if ($tampil) {
            return $tampil;
        }
    }
}
?>
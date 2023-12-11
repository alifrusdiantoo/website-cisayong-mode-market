// Menampilkan password pada halaman login
document.getElementById('tampilPassword').onclick = function () {
  if (this.checked) {
    document.getElementById('password').type = 'text';
  } else {
    document.getElementById('password').type = 'password';
  }
};

function pilihFoto() {
  document.querySelector('#fotoProfil').click();
}

function displayImage(e) {
  if (e.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      document.querySelector('#tampilFoto').setAttribute('src', e.target.result);
    };
    reader.readAsDataURL(e.files[0]);
  }
}

function hitungKarakter(str) {
  var lng = str.length;
  document.getElementById('hitung').innerHTML = lng;
}

function alertHapus(idPenjual) {
  if (confirm('Toko beserta produknya akan dihapus. Lanjut hapus?')) {
    document.location = '?hal=dashboard&aksi=hapus-toko&id=' + idPenjual;
  }
}

function alertHapusProduk(idPenjual, idProduk) {
  if (confirm('Produk akan dihapus permanen. Lanjut hapus?')) {
    document.location = '?hal=kelola-produk&aksi=hapus-produk&id=' + idPenjual + '&idProduk=' + idProduk;
  } else {
    return false;
  }
}

function buatPesanan(namaProduk, telp) {
  let variasi = document.querySelector('input[name=variasi]:checked').value;
  let ukuran = document.querySelector('input[name=ukuran]:checked').value;

  window.open('https://api.whatsapp.com/send?phone=' + telp + '&text=Assalamualaikum%2C%20Saya%20ingin%20pesan%20' + namaProduk + '%20variasi%20' + variasi + '%20ukuran%20' + ukuran, '_blank');
}

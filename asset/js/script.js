// Menampilkan password pada halaman login
document.getElementById('tampilPassword').onclick = function () {
  if (this.checked) {
    document.getElementById('password').type = 'text';
  } else {
    document.getElementById('password').type = 'password';
  }
};

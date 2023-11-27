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

// Fungsi tag variasi
function daftarVariasi() {
  document.addEventListener('DOMContentLoaded', function () {
    const tagsContainer = document.getElementById('variasi-container');
    const tagInput = document.getElementById('variasiProduk');
    const tagsHidden = document.getElementById('variasi-hidden');
    const submittedTags = [];

    tagInput.addEventListener('keyup', function (event) {
      if (event.key === 'Enter' || event.key === ',' || event.keyCode === 13) {
        const tags = tagInput.value.split(',');

        tags.forEach((tag) => {
          const tagValue = tag.trim();
          if (tagValue !== '') {
            createTag(tagValue);
            submittedTags.push(tagValue);
          }
        });

        updateHiddenInput();
        tagInput.value = '';
      }
    });

    function createTag(tagText) {
      const tag = document.createElement('div');
      tag.classList.add('tag');
      tag.textContent = tagText;

      const closeButton = document.createElement('span');
      closeButton.innerHTML = '&times;';
      closeButton.classList.add('close-button');
      closeButton.addEventListener('click', function () {
        tagsContainer.removeChild(tag);
        updateHiddenInput();
      });

      tag.appendChild(closeButton);
      tagsContainer.appendChild(tag);
      updateHiddenInput();
    }

    function updateHiddenInput() {
      const tagValues = Array.from(tagsContainer.children)
        .filter((tag) => !tag.querySelector('.close-button')) // Exclude tags with close buttons
        .map((tag) => tag.textContent);

      tagsHidden.value = tagValues.join(',');
    }

    // Optional: Prevent form submission for demonstration purposes
    const form = document.getElementById('form-produk');
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      console.log('Variasi:', submittedTags);
      // Add your custom form submission logic here
    });
  });
}

function daftarUkuran() {
  document.addEventListener('DOMContentLoaded', function () {
    const tagsContainer = document.getElementById('ukuran-container');
    const tagInput = document.getElementById('ukuranProduk');
    const tagsHidden = document.getElementById('ukuran-hidden');
    const submittedTags = [];

    tagInput.addEventListener('keyup', function (event) {
      if (event.key === 'Enter' || event.key === ',' || event.keyCode === 13) {
        const tags = tagInput.value.split(',');

        tags.forEach((tag) => {
          const tagValue = tag.trim();
          if (tagValue !== '') {
            createTag(tagValue);
            submittedTags.push(tagValue);
          }
        });

        updateHiddenInput();
        tagInput.value = '';
      }
    });

    function createTag(tagText) {
      const tag = document.createElement('div');
      tag.classList.add('tag');
      tag.textContent = tagText;

      const closeButton = document.createElement('span');
      closeButton.innerHTML = '&times;';
      closeButton.classList.add('close-button');
      closeButton.addEventListener('click', function () {
        tagsContainer.removeChild(tag);
        updateHiddenInput();
      });

      tag.appendChild(closeButton);
      tagsContainer.appendChild(tag);
      updateHiddenInput();
    }

    function updateHiddenInput() {
      const tagValues = Array.from(tagsContainer.children)
        .filter((tag) => !tag.querySelector('.close-button')) // Exclude tags with close buttons
        .map((tag) => tag.textContent);

      tagsHidden.value = tagValues.join(',');
    }

    // Optional: Prevent form submission for demonstration purposes
    const form = document.getElementById('form-produk');
    form.addEventListener('submit', function (event) {
      event.preventDefault();
      console.log('Ukuran:', submittedTags);
      // Add your custom form submission logic here
    });
  });
}

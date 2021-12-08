// FORM TAMBAH MAKANAN KHAS
const deskripsi_makanan = document.getElementById('deskripsi-skin-care');
const deskripsi_count = document.getElementById('deskripsi-count');

// ubah deskripsi count ketika deskripsi makanan berubah
deskripsi_makanan.oninput = (event) => {
  deskripsi_count.innerText = event.target.value.length + ' / 254';
};

// FORM UPDATE MAKANAN KHAS
const deskripsi_update_makanan = document.getElementById('update-deskripsi-skin-care');
const deskripsi_update_count = document.getElementById('update-deskripsi-count');

// ubah deskripsi count ketika deskripsi makanan berubah
deskripsi_update_makanan.oninput = (event) => {
  deskripsi_update_count.innerText = event.target.value.length + ' / 254';
};

// ubah data form update makanan khas sesuai makanan khas yang akan diedit
function updateEditMakananForm(skin_care_id, nama, brand, deskripsi) {
  document.getElementById('formUpdateMakanan').action += `update/${skin_care_id}`;
  document.getElementById('update-nama-skin-care').value = nama;
  document.getElementById('update-brand-skin-care').value = brand;
  document.getElementById('update-deskripsi-skin-care').value = deskripsi;
  deskripsi_update_count.innerText = deskripsi.length + ' / 254';
}
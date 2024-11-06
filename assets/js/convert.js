const hargaInput = document.getElementById("harga");

function formatRupiah(angka, prefix = "Rp ") {
  let number_string = angka.replace(/[^,\d]/g, "").toString(),
    split = number_string.split(","),
    sisa = split[0].length % 3,
    rupiah = split[0].substr(0, sisa),
    ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
    let separator = sisa ? "." : "";
    rupiah += separator + ribuan.join(".");
  }

  rupiah = split[1] !== undefined ? rupiah + "," + split[1] : rupiah;
  return prefix + rupiah;
}

hargaInput.addEventListener("keyup", function (e) {
  hargaInput.value = formatRupiah(this.value);
});

document.querySelector("form").addEventListener("submit", function () {
  hargaInput.value = hargaInput.value.replace(/Rp |\.|,/g, "");
});

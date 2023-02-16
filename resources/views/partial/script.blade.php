<script src="../../template/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
<script src="../../template/dist/assets/js/bootstrap.bundle.min.js"></script>
<script src="../../template/dist/assets/js/mazer.js"></script>
<script src="../../js/script.js"></script>
<script>
    function number_format(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
            split = number_string.split(","),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }

        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
        return prefix == undefined ? rupiah : rupiah ? "Rp. " + rupiah : "";
    }
</script>

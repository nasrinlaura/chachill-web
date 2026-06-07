<!-- ======================================= -->
<!-- FILE : simpan_ulasan.php -->
<!-- ======================================= -->

<?php

session_start();
include "dbconfig.php";

/* AMBIL DATA */

$nama =
$_POST['nama'];

$rating =
$_POST['rating'];

$komentar =
$_POST['komentar'];

/* SIMPAN */

$sql =
"INSERT INTO ULASAN
(NAMA,RATING,KOMENTAR,TANGGAL)
VALUES
('$nama','$rating','$komentar',SYSDATE)";

$stid =
oci_parse($conn,$sql);

$run =
oci_execute($stid);

/* BERHASIL */

if($run){

echo "

<script>

alert('Terima kasih atas ulasan Anda ❤️');

window.location='customer_dashboard.php';

</script>

";

}else{

echo "

<script>

alert('Ulasan gagal dikirim');

window.location='ulasan.php';

</script>

";

}

?>
<!-- ======================================= -->
<!-- FILE : hapus_pesanan.php -->
<!-- ======================================= -->

<?php

include "dbconfig.php";

$id = $_GET['id'];

/* HAPUS DATA */

$sql =
"DELETE FROM PESANAN
WHERE ID_PESANAN='$id'";

$parse =
oci_parse($conn,$sql);

oci_execute($parse);

/* KEMBALI */

header("Location: kasir_dashboard.php");

?>
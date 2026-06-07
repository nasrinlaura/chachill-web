<?php

include "dbconfig.php";

/* AMBIL ID */

$id =
$_GET['id'];

/* UPDATE STATUS */

$sql =
"UPDATE PESANAN
SET STATUS='Selesai'
WHERE ID_PESANAN='$id'";

$stid =
oci_parse($conn,$sql);

$run =
oci_execute($stid);

/* CEK */

if($run){

header("Location:dashboard.php");

}else{

echo "Gagal Konfirmasi";

}

?>
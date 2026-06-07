<?php

include "dbconfig.php";

$nama=$_POST['nama'];
$id_produk=$_POST['produk'];
$jumlah=$_POST['jumlah'];

$sql="SELECT HARGA FROM PRODUK WHERE ID_PRODUK='$id_produk'";

$stid=oci_parse($conn,$sql);
oci_execute($stid);

$row=oci_fetch_array($stid,OCI_ASSOC);

$harga=$row['HARGA'];

$subtotal=$harga*$jumlah;

$id_transaksi=rand(1,999);

$tanggal=date("d-M-y");

$sql1="INSERT INTO TRANSAKSI 
VALUES($id_transaksi,'$nama',
TO_DATE('$tanggal','DD-MON-YY'),
$subtotal)";

$stid1=oci_parse($conn,$sql1);
oci_execute($stid1);

$id_detail=rand(1000,9999);

$sql2="INSERT INTO DETAIL_TRANSAKSI 
VALUES($id_detail,$id_transaksi,
$id_produk,$jumlah,$subtotal)";

$stid2=oci_parse($conn,$sql2);
oci_execute($stid2);

echo "<script>
alert('Transaksi berhasil');
window.location='dashboard.php';
</script>";

?>
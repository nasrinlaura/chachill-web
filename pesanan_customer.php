<?php
session_start();
include "dbconfig.php";

$cart=$_SESSION['cart'];

?>

<!DOCTYPE html>
<html>
<head>

<title>Pesanan Customer</title>

<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

</head>

<body>

<div class="container mt-5">

<h2>Pesanan Saya</h2>

<table class="table table-bordered">

<tr>
<th>Produk</th>
<th>Jumlah</th>
<th>Harga</th>
<th>Total</th>
</tr>

<?php

$total=0;

foreach($cart as $id=>$jumlah){

$sql="SELECT * FROM PRODUK WHERE ID_PRODUK='$id'";

$stid=oci_parse($conn,$sql);
oci_execute($stid);

$row=oci_fetch_array($stid,OCI_ASSOC);

$harga=$row['HARGA'];

$subtotal=$harga*$jumlah;

$total+=$subtotal;

?>

<tr>

<td><?php echo $row['NAMA_PRODUK']; ?></td>

<td><?php echo $jumlah; ?></td>

<td><?php echo $harga; ?></td>

<td><?php echo $subtotal; ?></td>

</tr>

<?php } ?>

<tr>

<td colspan="3">Total</td>

<td><?php echo $total; ?></td>

</tr>

</table>

</div>

</body>
</html>
<?php
include "dbconfig.php";

$sql = "SELECT ID_TRANSAKSI, NAMA_PEMBELI,
        TO_CHAR(TANGGAL,'DD-MM-YYYY') AS TANGGAL,
        TOTAL
        FROM TRANSAKSI
        ORDER BY ID_TRANSAKSI";

$stid = oci_parse($conn,$sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html>

<head>

<title>Data Transaksi Chachill</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#fff6f8;
font-family:Poppins;
}

.title{
text-align:center;
color:#ff4d6d;
font-weight:bold;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2 class="title">Data Transaksi Chachill</h2>

<table class="table table-bordered table-striped mt-4">

<thead class="table-dark">

<tr>
<th>No</th>
<th>ID Transaksi</th>
<th>Nama Pembeli</th>
<th>Tanggal</th>
<th>Total</th>
</tr>

</thead>

<tbody>

<?php

$no=1;

while($row = oci_fetch_array($stid, OCI_ASSOC)){

?>

<tr>

<td><?php echo $no++; ?></td>

<td><?php echo $row['ID_TRANSAKSI']; ?></td>

<td><?php echo $row['NAMA_PEMBELI']; ?></td>

<td><?php echo $row['TANGGAL']; ?></td>

<td>Rp <?php echo number_format($row['TOTAL']); ?></td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</body>
</html>
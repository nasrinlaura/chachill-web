<?php
include "dbconfig.php";

$sql = "SELECT 
T.ID_TRANSAKSI,
T.NAMA_PEMBELI,
T.TANGGAL,
P.NAMA_PRODUK,
D.JUMLAH,
D.SUBTOTAL

FROM TRANSAKSI T
JOIN DETAIL_TRANSAKSI D ON T.ID_TRANSAKSI = D.ID_TRANSAKSI
JOIN PRODUK P ON D.ID_PRODUK = P.ID_PRODUK

ORDER BY T.ID_TRANSAKSI";

$stid = oci_parse($conn,$sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html>
<head>

<title>Laporan Transaksi Chachill</title>

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
margin-bottom:30px;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2 class="title">Laporan Transaksi Chachill</h2>

<table class="table table-bordered table-striped">

<thead class="table-dark">

<tr>

<th>ID Transaksi</th>
<th>Nama Pembeli</th>
<th>Tanggal</th>
<th>Produk</th>
<th>Jumlah</th>
<th>Subtotal</th>

</tr>

</thead>

<tbody>

<?php
while($row = oci_fetch_array($stid,OCI_ASSOC)){
?>

<tr>

<td><?php echo $row['ID_TRANSAKSI']; ?></td>

<td><?php echo $row['NAMA_PEMBELI']; ?></td>

<td><?php echo $row['TANGGAL']; ?></td>

<td><?php echo $row['NAMA_PRODUK']; ?></td>

<td><?php echo $row['JUMLAH']; ?></td>

<td>Rp <?php echo number_format($row['SUBTOTAL']); ?></td>

</tr>

<?php
}
?>

</tbody>

</table>

</div>

</body>
</html>
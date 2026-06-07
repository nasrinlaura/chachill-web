<?php
include "dbconfig.php";

$sql = "SELECT * FROM PRODUK ORDER BY ID_PRODUK";
$stid = oci_parse($conn,$sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html>
<head>

<title>Menu Minuman Chachill</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">

<style>

body{
background:#fff6f8;
font-family:Poppins, sans-serif;
}

.title{
text-align:center;
margin-bottom:40px;
font-weight:bold;
color:#ff4d6d;
}

.card{
border:none;
border-radius:15px;
box-shadow:0 6px 15px rgba(0,0,0,0.1);
transition:0.3s;
}

.card:hover{
transform:scale(1.05);
}

.card img{
height:200px;
object-fit:cover;
border-top-left-radius:15px;
border-top-right-radius:15px;
}

.harga{
color:#ff4d6d;
font-size:18px;
font-weight:bold;
}

.btn-order{
background:#ff4d6d;
color:white;
border:none;
border-radius:30px;
padding:8px 20px;
font-weight:bold;
}

.btn-order:hover{
background:#e63950;
color:white;
}

</style>

</head>

<body>

<div class="container mt-5">

<h2 class="title">Menu Minuman Chachill</h2>

<div class="row">

<?php
while($row = oci_fetch_array($stid,OCI_ASSOC)){

$nama = $row['NAMA_PRODUK'];
$harga = number_format($row['HARGA']);
$gambar = $row['GAMBAR'];

$pesan = "Halo, saya ingin memesan ".$nama." di Chachill";
$link = "https://wa.me/6281234567890?text=".urlencode($pesan);
?>

<div class="col-md-3 mb-4">

<div class="card">

<img src="image/<?php echo $gambar; ?>" class="card-img-top">

<div class="card-body text-center">

<h5><?php echo $nama; ?></h5>

<p class="harga">Rp <?php echo $harga; ?></p>

<a href="<?php echo $link; ?>" target="_blank" class="btn btn-order">
Pesan Sekarang
</a>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
</html>
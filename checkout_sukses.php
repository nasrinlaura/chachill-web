<?php

session_start();
include "dbconfig.php";

/* =========================
   CEK KERANJANG
========================= */

if(
!isset($_SESSION['cart'])
||
empty($_SESSION['cart'])
){

header("Location: keranjang.php");
exit;

}

$cart =
$_SESSION['cart'];

$username =
$_SESSION['username'] ?? 'Customer';

$metode =
$_POST['metode'] ?? 'Transfer';

$bank =
$_POST['bank'] ?? 'BCA';

$total = 0;

/* =========================
   HITUNG TOTAL
========================= */

foreach(
$cart as $id_produk => $jumlah
){

$sqlProduk = "
SELECT *
FROM PRODUK
WHERE ID_PRODUK='$id_produk'
";

$stidProduk =
oci_parse(
$conn,
$sqlProduk
);

oci_execute($stidProduk);

$produk =
oci_fetch_array(
$stidProduk,
OCI_ASSOC
);

if($produk){

$total +=
$produk['HARGA'] * $jumlah;

}

}

/* =========================
   INSERT PESANAN
========================= */

$id_pesanan =
rand(1000,9999);

$sqlPesanan = "
INSERT INTO PESANAN
(
ID_PESANAN,
USERNAME,
TOTAL,
METODE_PEMBAYARAN,
STATUS,
TANGGAL
)

VALUES
(
'$id_pesanan',
'$username',
'$total',
'$metode',
'Pending',
SYSDATE
)
";

$stidPesanan =
oci_parse(
$conn,
$sqlPesanan
);

oci_execute($stidPesanan);

/* =========================
   INSERT DETAIL PESANAN
========================= */

$detail_produk = [];

foreach(
$cart as $id_produk => $jumlah
){

$sqlProduk = "
SELECT *
FROM PRODUK
WHERE ID_PRODUK='$id_produk'
";

$stidProduk =
oci_parse(
$conn,
$sqlProduk
);

oci_execute($stidProduk);

$produk =
oci_fetch_array(
$stidProduk,
OCI_ASSOC
);

if($produk){

$harga =
$produk['HARGA'];

$subtotal =
$harga * $jumlah;

/* =========================
   INSERT DETAIL
========================= */

$sqlDetail = "
INSERT INTO DETAIL_PESANAN
(
ID_PESANAN,
ID_PRODUK,
JUMLAH,
SUBTOTAL
)

VALUES
(
'$id_pesanan',
'$id_produk',
'$jumlah',
'$subtotal'
)
";

$stidDetail =
oci_parse(
$conn,
$sqlDetail
);

oci_execute($stidDetail);

/* =========================
   UPDATE STOK OTOMATIS
========================= */

$stok_lama =
$produk['STOK'];

$stok_baru =
$stok_lama - $jumlah;

/* CEGAH STOK MINUS */

if($stok_baru < 0){

$stok_baru = 0;

}

/* UPDATE DATABASE */

$sqlUpdateStok = "
UPDATE PRODUK
SET STOK = :stok
WHERE ID_PRODUK = :id
";

$updateStok =
oci_parse(
$conn,
$sqlUpdateStok
);

oci_bind_by_name(
$updateStok,
":stok",
$stok_baru
);

oci_bind_by_name(
$updateStok,
":id",
$id_produk
);

oci_execute($updateStok);

/* =========================
   ARRAY TAMPILAN
========================= */

$detail_produk[] = [

'nama' =>
$produk['NAMA_PRODUK'],

'gambar' =>
$produk['GAMBAR'],

'harga' =>
$harga,

'jumlah' =>
$jumlah,

'subtotal' =>
$subtotal

];

}

}

/* =========================
   HAPUS CART
========================= */

unset($_SESSION['cart']);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Checkout Berhasil | ChaChill

</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:
linear-gradient(
135deg,
#fff7ed,
#ffedd5
);

min-height:100vh;

display:flex;
justify-content:center;
align-items:center;

padding:40px;

}

/* CARD */

.card{

width:100%;
max-width:550px;

background:white;

border-radius:35px;

overflow:hidden;

box-shadow:
0 20px 40px rgba(255,107,0,0.15);

border:
3px solid #fff1e6;

animation:fadeIn 0.7s ease;

}

@keyframes fadeIn{

from{
opacity:0;
transform:translateY(40px);
}

to{
opacity:1;
transform:translateY(0);
}

}

/* HEADER */

.header{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:40px;

text-align:center;

color:white;

}

.logo{

font-size:70px;

margin-bottom:10px;

animation:bounce 2s infinite;

}

@keyframes bounce{

0%{
transform:translateY(0);
}

50%{
transform:translateY(-8px);
}

100%{
transform:translateY(0);
}

}

.header h1{

font-size:50px;
font-weight:800;

margin-bottom:10px;

}

.header p{

font-size:15px;

line-height:1.7;

}

/* CONTENT */

.content{

padding:30px;

}

/* INFO */

.info{

background:#fff7ed;

padding:25px;

border-radius:25px;

border:
2px solid #fed7aa;

margin-bottom:30px;

}

.info-row{

display:flex;
justify-content:space-between;

margin-bottom:15px;

font-size:15px;

}

.info-row:last-child{
margin-bottom:0;
}

.label{

font-weight:700;
color:#111827;

}

.value{

color:#64748b;

}

/* TABLE */

.table{

width:100%;

border-collapse:collapse;

}

.table th{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:14px;

color:white;

font-size:14px;

}

.table td{

padding:18px 10px;

border-bottom:1px dashed #fed7aa;

}

/* PRODUCT */

.product{

display:flex;
align-items:center;
gap:12px;

}

.product img{

width:70px;
height:70px;

border-radius:18px;

object-fit:cover;

border:
2px solid #fff1e6;

}

.product h4{

font-size:17px;
font-weight:700;

margin-bottom:5px;

color:#111827;

}

.product p{

font-size:13px;

color:#64748b;

}

/* TOTAL */

.total{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:25px;

border-radius:25px;

display:flex;
justify-content:space-between;
align-items:center;

color:white;

margin-top:30px;

}

.total h2{

font-size:20px;
font-weight:700;

}

.total h1{

font-size:38px;
font-weight:800;

}

/* THANK */

.thank{

text-align:center;

padding:35px 10px;

}

.thank h2{

font-size:38px;
font-weight:800;

color:#ff6b00;

margin-bottom:12px;

}

.thank p{

font-size:15px;

line-height:1.8;

color:#64748b;

}

/* BUTTON */

.btn-group{

display:flex;
gap:15px;

margin-top:30px;

}

.btn{

flex:1;

height:60px;

border:none;

border-radius:18px;

font-size:16px;
font-weight:700;

cursor:pointer;

transition:0.3s;

}

.btn:hover{

transform:translateY(-3px);

}

/* PRINT */

.print{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

}

/* BACK */

.back{

background:#fff7ed;

color:#ff6b00;

border:
2px solid #fed7aa;

}

/* RESPONSIVE */

@media(max-width:600px){

.card{
width:100%;
}

.header h1{
font-size:38px;
}

.total h1{
font-size:30px;
}

.btn-group{
flex-direction:column;
}

}

</style>

</head>

<body>

<div class="card">

<!-- HEADER -->

<div class="header">

<div class="logo">

🧋

</div>

<h1>

ChaChill

</h1>

<p>

Fresh Drink Premium Modern Cafe

</p>

<p>

Jl. Pembangunan Medan

</p>

<p>

0821-7430-6895

</p>

</div>

<!-- CONTENT -->

<div class="content">

<!-- INFO -->

<div class="info">

<div class="info-row">

<div class="label">
No Struk
</div>

<div class="value">
#<?= $id_pesanan ?>
</div>

</div>

<div class="info-row">

<div class="label">
Customer
</div>

<div class="value">
<?= $username ?>
</div>

</div>

<div class="info-row">

<div class="label">
Tanggal
</div>

<div class="value">
<?= date('d M Y H:i') ?>
</div>

</div>

<div class="info-row">

<div class="label">
Metode
</div>

<div class="value">
<?= $metode ?>
</div>

</div>

<div class="info-row">

<div class="label">
Pembayaran
</div>

<div class="value">
Transfer ChaChill
</div>

</div>

</div>

<!-- TABLE -->

<table class="table">

<thead>

<tr>

<th>Menu</th>
<th>Qty</th>
<th>Total</th>

</tr>

</thead>

<tbody>

<?php foreach($detail_produk as $item){ ?>

<tr>

<td>

<div class="product">

<img
src="image/<?= $item['gambar'] ?>">

<div>

<h4>

<?= $item['nama'] ?>

</h4>

<p>

Rp <?= number_format($item['harga']) ?>

</p>

</div>

</div>

</td>

<td>

<?= $item['jumlah'] ?>

</td>

<td>

Rp <?= number_format($item['subtotal']) ?>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<!-- TOTAL -->

<div class="total">

<h2>

Total Bayar

</h2>

<h1>

Rp <?= number_format($total) ?>

</h1>

</div>

<!-- THANK -->

<div class="thank">

<h2>

Terima Kasih 🧋

</h2>

<p>

Pesanan ChaChill sedang diproses.<br>
Simpan struk ini sebagai bukti pembayaran.

</p>

<div class="btn-group">

<button
onclick="window.print()"
class="btn print">

🖨 Cetak Struk

</button>

<a
href="customer_dashboard.php"
style="
flex:1;
text-decoration:none;
">

<button class="btn back">

🏠 Kembali

</button>

</a>

</div>

</div>

</div>

</div>

</body>
</html>
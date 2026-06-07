<?php

session_start();
include "dbconfig.php";

/* =========================
   CEK ID PESANAN
========================= */

if(!isset($_GET['id'])){

die("ID Pesanan Tidak Ditemukan");

}

$id = $_GET['id'];

/* =========================
   AMBIL DATA PESANAN
========================= */

$sql =
"SELECT * FROM PESANAN
WHERE ID_PESANAN = :id";

$stid =
oci_parse($conn,$sql);

oci_bind_by_name(
$stid,
":id",
$id
);

oci_execute($stid);

$data =
oci_fetch_array(
$stid,
OCI_ASSOC
);

if(!$data){

die("Data Pesanan Tidak Ada");

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Struk ChaChill

</title>

<!-- FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

body{

background:#e5e7eb;

font-family:
'Courier Prime',
monospace;

padding:30px;

}

/* =========================
   STRUK
========================= */

.struk{

width:380px;

margin:auto;

background:white;

padding:25px;

box-shadow:
0 5px 15px rgba(0,0,0,0.15);

border-radius:10px;

}

/* =========================
   CENTER
========================= */

.center{
text-align:center;
}

/* =========================
   LOGO
========================= */

.logo{

font-size:50px;

margin-bottom:10px;

}

/* =========================
   BRAND
========================= */

.brand{

font-size:30px;

font-weight:bold;

margin-bottom:5px;

}

/* =========================
   SMALL TEXT
========================= */

.small{

font-size:14px;

line-height:1.8;

}

/* =========================
   LINE
========================= */

.line{

border-top:
2px dashed black;

margin:18px 0;

}

/* =========================
   ROW
========================= */

.row{

display:flex;

justify-content:space-between;

margin-bottom:10px;

font-size:15px;

}

/* =========================
   TOTAL
========================= */

.total{

font-size:22px;

font-weight:bold;

margin-top:15px;

}

/* =========================
   THANKS
========================= */

.thanks{

margin-top:25px;

text-align:center;

font-size:15px;

line-height:1.8;

}

/* =========================
   BUTTON
========================= */

.button-area{

margin-top:25px;

display:flex;

justify-content:center;

gap:15px;

flex-wrap:wrap;

}

.btn{

padding:12px 20px;

border:none;

border-radius:10px;

font-size:15px;

font-weight:bold;

cursor:pointer;

text-decoration:none;

transition:0.3s;

}

.print{

background:#22c55e;

color:white;

}

.back{

background:#64748b;

color:white;

}

.btn:hover{

transform:translateY(-3px);

}

/* =========================
   PRINT
========================= */

@media print{

body{
background:white;
padding:0;
}

.button-area{
display:none;
}

.struk{
box-shadow:none;
width:100%;
}

}

</style>

</head>

<body>

<div class="struk">

<!-- =========================
     HEADER
========================= -->

<div class="center">

<div class="logo">
🥤
</div>

<div class="brand">

ChaChill

</div>

<div class="small">

Fresh Drink Premium Taste
<br>

Jl. ChaChill No. 1 Medan
<br>

Telp : 0812-3456-7890

</div>

</div>

<div class="line"></div>

<!-- =========================
     INFO PESANAN
========================= -->

<div class="row">

<div>No Struk</div>

<div>

#<?= $data['ID_PESANAN']; ?>

</div>

</div>

<div class="row">

<div>Customer</div>

<div>

<?= $data['USERNAME']; ?>

</div>

</div>

<div class="row">

<div>Pembayaran</div>

<div>

<?= $data['METODE_PEMBAYARAN']; ?>

</div>

</div>

<div class="row">

<div>Status</div>

<div>

<?= $data['STATUS']; ?>

</div>

</div>

<div class="row">

<div>Tanggal</div>

<div>

<?php

if(isset($data['TANGGAL'])){

echo date(
'd/m/Y H:i:s',
strtotime($data['TANGGAL'])
);

}else{

echo date('d/m/Y H:i:s');

}

?>

</div>

</div>

<div class="line"></div>

<!-- =========================
     ITEM PESANAN
========================= -->

<div class="row">

<div>

Menu Minuman

</div>

<div>

1x

</div>

</div>

<div class="row">

<div>

ChaChill Drink

</div>

<div>

Rp <?= number_format($data['TOTAL'],0,',','.'); ?>

</div>

</div>

<div class="line"></div>

<!-- =========================
     TOTAL
========================= -->

<div class="row total">

<div>

TOTAL

</div>

<div>

Rp <?= number_format($data['TOTAL'],0,',','.'); ?>

</div>

</div>

<div class="line"></div>

<!-- =========================
     FOOTER
========================= -->

<div class="thanks">

Terima Kasih 🙏
<br>

Selamat Menikmati ChaChill
<br><br>

www.chachill.com

</div>

<!-- =========================
     BUTTON
========================= -->

<div class="button-area">

<button
onclick="window.print()"
class="btn print">

🖨️ Cetak

</button>

<a
href="pesanan.php"
class="btn back">

⬅ Kembali

</a>

</div>

</div>

</body>
</html>
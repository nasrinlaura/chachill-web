<!-- ======================================= -->
<!-- FILE : cetak_struk.php FINAL -->
<!-- ======================================= -->

<?php

include "dbconfig.php";

/* ID PESANAN */

$id =
$_GET['id'];

/* DATA PESANAN */

$sql =
"SELECT * FROM PESANAN
WHERE ID_PESANAN='$id'";

$stid =
oci_parse($conn,$sql);

oci_execute($stid);

$row =
oci_fetch_array($stid,OCI_ASSOC);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Struk ChaChill</title>

<!-- FONT -->

<link href="https://fonts.googleapis.com/css2?family=Courier+Prime:wght@400;700&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
}

/* ====================================== */
/* BODY */
/* ====================================== */

body{

background:#e5e7eb;

display:flex;
justify-content:center;
align-items:center;

padding:40px;

font-family:'Courier Prime',monospace;

}

/* ====================================== */
/* STRUK */
/* ====================================== */

.struk{

width:340px;

background:white;

padding:25px;

box-shadow:
0 10px 25px rgba(0,0,0,0.1);

border-radius:10px;

}

/* ====================================== */
/* TITLE */
/* ====================================== */

.title{

text-align:center;

font-size:32px;
font-weight:bold;

margin-bottom:10px;

}

/* ====================================== */
/* SUBTITLE */
/* ====================================== */

.subtitle{

text-align:center;

font-size:14px;

margin-bottom:5px;

}

/* ====================================== */
/* LINE */
/* ====================================== */

.line{

border-top:
2px dashed #000;

margin:15px 0;

}

/* ====================================== */
/* ITEM */
/* ====================================== */

.item{

display:flex;

justify-content:space-between;

margin-bottom:10px;

font-size:15px;

}

/* ====================================== */
/* CENTER */
/* ====================================== */

.center{

text-align:center;

}

/* ====================================== */
/* TOTAL */
/* ====================================== */

.total{

font-size:20px;
font-weight:bold;

margin-top:10px;

}

/* ====================================== */
/* THANKS */
/* ====================================== */

.thanks{

text-align:center;

margin-top:20px;

font-size:14px;

line-height:1.7;

}

/* ====================================== */
/* BUTTON */
/* ====================================== */

.btn-print{

width:100%;

height:50px;

margin-top:25px;

border:none;

background:black;

color:white;

font-size:16px;
font-weight:bold;

cursor:pointer;

border-radius:5px;

transition:0.3s;

}

.btn-print:hover{

opacity:0.9;

}

/* ====================================== */
/* PRINT */
/* ====================================== */

@media print{

body{

background:white;

padding:0;

}

.btn-print{

display:none;

}

.struk{

box-shadow:none;

border-radius:0;

}

}

</style>

</head>

<body>

<div class="struk">

<!-- HEADER -->

<div class="title">

🧋 ChaChill

</div>

<div class="subtitle">

Jl. ChaChill No. 1

</div>

<div class="subtitle">

Telp : 0812-3456-7890

</div>

<div class="line"></div>

<!-- DETAIL -->

<div class="item">

<div>ID</div>

<div>

#<?php echo $row['ID_PESANAN']; ?>

</div>

</div>

<div class="item">

<div>Waktu</div>

<div>

<?php echo date(
'd M Y • H:i WIB',
strtotime($row['TANGGAL'])
); ?>

</div>

</div>

<div class="item">

<div>Customer</div>

<div>

<?php echo $row['NAMA_CUSTOMER']; ?>

</div>

</div>

<div class="line"></div>

<!-- TOTAL -->

<div class="item total">

<div>TOTAL</div>

<div>

Rp <?php echo number_format($row['TOTAL']); ?>

</div>

</div>

<div class="line"></div>

<!-- STATUS -->

<div class="item">

<div>Status</div>

<div>

<?php echo $row['STATUS']; ?>

</div>

</div>

<div class="line"></div>

<!-- FOOTER -->

<div class="center">

Barang yang sudah dibeli
tidak dapat dikembalikan

</div>

<div class="thanks">

Terima kasih telah membeli
di ChaChill ❤️

</div>

<!-- BUTTON -->

<button
onclick="window.print()"
class="btn-print">

CETAK STRUK

</button>

</div>

</body>
</html>
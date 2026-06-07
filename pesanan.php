<?php

include 'dbconfig.php';

/* =========================================
   TOTAL PESANAN
========================================= */

$totalPesanan = 0;

$qPesanan = oci_parse(
$conn,
"SELECT COUNT(*) AS TOTAL FROM PESANAN"
);

oci_execute($qPesanan);

$dataPesanan = oci_fetch_array(
$qPesanan,
OCI_ASSOC
);

$totalPesanan =
$dataPesanan['TOTAL'];

/* =========================================
   TOTAL OMZET
========================================= */

$totalOmzet = 0;

$qOmzet = oci_parse(
$conn,
"SELECT NVL(SUM(TOTAL),0) AS TOTAL FROM PESANAN"
);

oci_execute($qOmzet);

$dataOmzet = oci_fetch_array(
$qOmzet,
OCI_ASSOC
);

$totalOmzet =
$dataOmzet['TOTAL'];

/* =========================================
   UPDATE STATUS
========================================= */

if(isset($_POST['update_status'])){

$id =
$_POST['id'];

$status =
$_POST['status'];

$update = oci_parse(
$conn,
"UPDATE PESANAN
SET STATUS = :status
WHERE ID_PESANAN = :id"
);

oci_bind_by_name(
$update,
":status",
$status
);

oci_bind_by_name(
$update,
":id",
$id
);

oci_execute($update);

header(
"Location: pesanan.php"
);

exit();

}

/* =========================================
   HAPUS PESANAN
========================================= */

if(isset($_GET['hapus'])){

$id =
$_GET['hapus'];

$hapus = oci_parse(
$conn,
"DELETE FROM PESANAN
WHERE ID_PESANAN = :id"
);

oci_bind_by_name(
$hapus,
":id",
$id
);

oci_execute($hapus);

header(
"Location: pesanan.php"
);

exit();

}

/* =========================================
   DATA PESANAN
========================================= */

$pesanan = oci_parse(
$conn,
"SELECT * FROM PESANAN
ORDER BY ID_PESANAN DESC"
);

oci_execute($pesanan);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>

Pesanan ChaChill

</title>

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>

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

display:flex;

overflow-x:hidden;

}

/* SIDEBAR */

.sidebar{

width:260px;
height:100vh;

background:
linear-gradient(
180deg,
#ff9800,
#ff6b00
);

padding:30px 20px;

position:fixed;

left:0;
top:0;

overflow:auto;

box-shadow:
0 0 20px rgba(0,0,0,0.1);

}

.logo{
font-size:55px;
text-align:center;
margin-bottom:10px;
}

.brand{
font-size:42px;
font-weight:bold;
text-align:center;
margin-bottom:40px;
color:white;
}

.brand span{
color:#fff3d4;
}

.menu a{

display:flex;
align-items:center;
gap:15px;

padding:16px 20px;

border-radius:18px;

text-decoration:none;

color:white;

font-size:18px;
font-weight:600;

margin-bottom:15px;

transition:0.3s;

}

.menu a:hover{

background:white;
color:#ff7a00;

transform:translateX(5px);

}

.menu a.active{

background:white;

color:#ff7a00;

box-shadow:
0 5px 15px rgba(0,0,0,0.1);

}

/* MAIN */

.main{
margin-left:260px;
padding:35px;
width:100%;
}

/* HEADER */

.header{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:35px;

border-radius:30px;

color:white;

margin-bottom:30px;

box-shadow:
0 10px 25px rgba(0,0,0,0.12);

}

.header h1{
font-size:42px;
margin-bottom:10px;
}

.header p{
font-size:18px;
opacity:0.9;
}

/* CARDS */

.cards{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(250px,1fr));

gap:25px;

margin-bottom:30px;

}

.card{

background:white;

border:
2px solid #fff1e6;

padding:35px;

border-radius:25px;

text-align:center;

box-shadow:
0 10px 20px rgba(0,0,0,0.08);

transition:0.3s;

}

.card:hover{

transform:translateY(-5px);

}

.card i{

font-size:35px;

margin-bottom:20px;

color:#ff9800;

}

.card h2{

font-size:38px;

margin-bottom:10px;

color:#111827;

}

.card p{

font-size:18px;

color:#6b7280;

}

/* TABLE */

.table-box{

background:white;

border:
2px solid #fff1e6;

padding:30px;

border-radius:25px;

box-shadow:
0 10px 20px rgba(0,0,0,0.08);

overflow:auto;

}

.table-title{

font-size:30px;
font-weight:bold;

margin-bottom:25px;

color:#111827;

}

table{
width:100%;
border-collapse:collapse;
min-width:900px;
}

table th{

background:#ff9800;

color:white;

padding:16px;

font-size:16px;

}

table td{

padding:18px;

border-bottom:1px solid #eee;

text-align:center;

font-size:15px;

vertical-align:middle;

}

/* BADGE */

.badge{

padding:10px 16px;

border-radius:20px;

color:white;

font-size:14px;

font-weight:bold;

display:inline-block;

}

.pending{
background:#f59e0b;
}

.selesai{
background:#22c55e;
}

.proses{
background:#3b82f6;
}

/* BUTTON */

.action-btn{

padding:12px 16px;

border:none;

border-radius:14px;

font-size:14px;

font-weight:bold;

cursor:pointer;

color:white;

margin-top:8px;

width:100%;

transition:0.3s;

}

.action-btn:hover{

transform:translateY(-3px);

opacity:0.9;

}

.update-btn{
background:#2563eb;
}

.delete-btn{
background:#ef4444;
}

.print-btn{
background:#22c55e;
}

/* SELECT */

select{

padding:12px;

border-radius:12px;

border:1px solid #ddd;

width:100%;

margin-bottom:10px;

outline:none;

font-weight:600;

}

/* RESPONSIVE */

@media(max-width:900px){

.sidebar{
width:100%;
height:auto;
position:relative;
}

.main{
margin-left:0;
padding:20px;
}

table{
display:block;
overflow:auto;
}

.header h1{
font-size:30px;
}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">
🥤
</div>

<div class="brand">
Cha<span>Chill</span>
</div>

<div class="menu">

<a
href="kasir_dashboard.php">

<i class="fa-solid fa-house"></i>

Dashboard

</a>

<a
href="pesanan.php"
class="active">

<i class="fa-solid fa-mug-hot"></i>

Data Pesanan

</a>


<a
href="admin_ulasan.php">

<i class="fa-solid fa-star"></i>

Ulasan

</a>

<a href="logout.php">

<i class="fa-solid fa-right-from-bracket"></i>

Logout

</a>

</div>

</div>

<!-- MAIN -->

<div class="main">

<!-- HEADER -->

<div class="header">

<h1>
Dashboard Pesanan ChaChill 🥤
</h1>

<p>
Monitoring transaksi customer realtime modern
</p>

</div>

<!-- CARDS -->

<div class="cards">

<div class="card">

<i class="fa-solid fa-cart-shopping"></i>

<h2>

<?= $totalPesanan ?>

</h2>

<p>

Total Pesanan

</p>

</div>

<div class="card">

<i class="fa-solid fa-wallet"></i>

<h2>

Rp <?= number_format($totalOmzet,0,',','.') ?>

</h2>

<p>

Total Omzet

</p>

</div>

</div>

<!-- TABLE -->

<div class="table-box">

<div class="table-title">

<i class="fa-solid fa-list"></i>

Daftar Pesanan Customer

</div>

<table>

<thead>

<tr>

<th>ID</th>
<th>Customer</th>
<th>Total</th>
<th>Pembayaran</th>
<th>Status</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
while(
$row = oci_fetch_array(
$pesanan,
OCI_ASSOC
)
){
?>

<tr>

<td>

#<?= $row['ID_PESANAN'] ?>

</td>

<td>

<?= $row['USERNAME'] ?>

</td>

<td>

Rp <?= number_format($row['TOTAL'],0,',','.') ?>

</td>

<td>

<?= $row['METODE_PEMBAYARAN'] ?>

</td>

<td>

<?php

$status =
strtolower(
$row['STATUS']
);

?>

<span class="badge <?= $status ?>">

<?= $row['STATUS'] ?>

</span>

</td>

<td>

<form method="POST">

<input
type="hidden"
name="id"
value="<?= $row['ID_PESANAN'] ?>">

<select name="status">

<option
value="Pending"

<?= $row['STATUS']=='Pending'
? 'selected'
: ''
?>>

Pending

</option>

<option
value="Proses"

<?= $row['STATUS']=='Proses'
? 'selected'
: ''
?>>

Proses

</option>

<option
value="Selesai"

<?= $row['STATUS']=='Selesai'
? 'selected'
: ''
?>>

Selesai

</option>

</select>

<button
type="submit"
name="update_status"
class="action-btn update-btn">

<i class="fa-solid fa-pen"></i>

Update Status

</button>

</form>

<a
href="struk.php?id=<?= $row['ID_PESANAN'] ?>">

<button
class="action-btn print-btn">

<i class="fa-solid fa-print"></i>

Cetak Struk

</button>

</a>

<a
href="?hapus=<?= $row['ID_PESANAN'] ?>"

onclick="return confirm('Yakin ingin hapus pesanan ini?')">

<button
class="action-btn delete-btn">

<i class="fa-solid fa-trash"></i>

Hapus

</button>

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>
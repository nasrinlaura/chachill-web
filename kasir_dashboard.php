<?php

include 'dbconfig.php';

/* =========================
   TOTAL PRODUK
========================= */

$totalProduk = 0;

$qProduk = oci_parse(
$conn,
"SELECT COUNT(*) AS TOTAL FROM PRODUK"
);

if(oci_execute($qProduk)){

$dataProduk = oci_fetch_array(
$qProduk,
OCI_ASSOC
);

$totalProduk =
$dataProduk['TOTAL'];

}

/* =========================
   TOTAL PESANAN
========================= */

$totalPesanan = 0;

$qPesanan = oci_parse(
$conn,
"SELECT COUNT(*) AS TOTAL FROM PESANAN"
);

if(oci_execute($qPesanan)){

$dataPesanan = oci_fetch_array(
$qPesanan,
OCI_ASSOC
);

$totalPesanan =
$dataPesanan['TOTAL'];

}

/* =========================
   TOTAL STOK
========================= */

$totalStok = 0;

$qStok = oci_parse(
$conn,
"SELECT NVL(SUM(STOK),0) AS TOTAL FROM PRODUK"
);

if(oci_execute($qStok)){

$dataStok = oci_fetch_array(
$qStok,
OCI_ASSOC
);

$totalStok =
$dataStok['TOTAL'];

}

/* =========================
   TOTAL OMZET
========================= */

$totalOmzet = 0;

$qOmzet = oci_parse(
$conn,
"SELECT NVL(SUM(TOTAL),0) AS TOTAL FROM PESANAN"
);

if(oci_execute($qOmzet)){

$dataOmzet = oci_fetch_array(
$qOmzet,
OCI_ASSOC
);

$totalOmzet =
$dataOmzet['TOTAL'];

}

/* =========================
   TAMBAH PRODUK
========================= */

if(isset($_POST['tambah_produk'])){

$id = rand(1000,9999);

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

$gambar = "";

if(isset($_FILES['gambar'])){

$gambar =
time() .
$_FILES['gambar']['name'];

$tmp =
$_FILES['gambar']['tmp_name'];

$folder =
"image/" . $gambar;

move_uploaded_file(
$tmp,
$folder
);

}

$query = "
INSERT INTO PRODUK
(
ID_PRODUK,
NAMA_PRODUK,
HARGA,
STOK,
GAMBAR
)

VALUES
(
:id,
:nama,
:harga,
:stok,
:gambar
)
";

$insert = oci_parse(
$conn,
$query
);

oci_bind_by_name($insert,":id",$id);
oci_bind_by_name($insert,":nama",$nama);
oci_bind_by_name($insert,":harga",$harga);
oci_bind_by_name($insert,":stok",$stok);
oci_bind_by_name($insert,":gambar",$gambar);

oci_execute($insert);

header(
"Location: kasir_dashboard.php"
);

}

/* =========================
   HAPUS PRODUK
========================= */

if(isset($_GET['hapus'])){

$idHapus = $_GET['hapus'];

$hapus = oci_parse(
$conn,
"DELETE FROM PRODUK
WHERE ID_PRODUK = :id"
);

oci_bind_by_name(
$hapus,
":id",
$idHapus
);

oci_execute($hapus);

header(
"Location: kasir_dashboard.php"
);

}

/* =========================
   DATA PRODUK
========================= */

$produk = oci_parse(
$conn,
"SELECT * FROM PRODUK
ORDER BY ID_PRODUK DESC"
);

oci_execute($produk);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Dashboard ChaChill</title>

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
/>

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

}

.menu a.active{

background:white;
color:#ff7a00;

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
repeat(auto-fit,minmax(220px,1fr));

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

margin-bottom:8px;

color:#111827;

}

.card p{

font-size:18px;

color:#6b7280;

}

/* SEARCH */

.search-box{

background:white;

padding:25px;

border-radius:24px;

margin-bottom:30px;

border:
2px solid #fff1e6;

box-shadow:
0 10px 20px rgba(0,0,0,0.08);

}

.search-box form{

display:grid;

grid-template-columns:
2fr 1fr;

gap:15px;

}

.search-input{

padding:15px 18px;

border-radius:14px;

border:1px solid #dbe2ea;

font-size:15px;

outline:none;

}

.search-btn{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

border:none;

border-radius:15px;

color:white;

font-size:16px;

font-weight:bold;

cursor:pointer;

transition:0.3s;

}

.search-btn:hover{

transform:translateY(-3px);

}

/* FORM */

.form-box{

background:white;

border:
2px solid #fff1e6;

padding:30px;

border-radius:25px;

margin-bottom:30px;

box-shadow:
0 10px 20px rgba(0,0,0,0.08);

}

.form-title{

font-size:30px;
font-weight:bold;

margin-bottom:25px;

display:flex;
align-items:center;
gap:12px;

color:#111827;

}

.form-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(220px,1fr));

gap:20px;

margin-bottom:25px;

}

.input-group{
display:flex;
flex-direction:column;
}

.input-group label{

margin-bottom:8px;

font-weight:600;

color:#374151;

}

.input-group input{

padding:14px;

border-radius:14px;

border:1px solid #dbe2ea;

font-size:15px;

outline:none;

}

.save-btn{

padding:15px 30px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

border:none;

border-radius:15px;

color:white;

font-size:16px;

font-weight:bold;

cursor:pointer;

transition:0.3s;

}

.save-btn:hover{

transform:translateY(-3px);

}

/* TABLE */

.table-box{

background:#fff;

border:
2px solid #fff1e6;

padding:30px;

border-radius:25px;

box-shadow:
0 10px 20px rgba(0,0,0,0.08);

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
}

table th{

background:#ff9800;

color:white;

padding:16px;

font-size:16px;

}

table td{

padding:16px;

border-bottom:1px solid #eee;

text-align:center;

vertical-align:middle;

}

.produk-img{

width:90px;
height:90px;

object-fit:cover;

border-radius:18px;

border:3px solid #fff3e0;

box-shadow:
0 5px 12px rgba(0,0,0,0.1);

}

.badge{

background:#22c55e;

padding:8px 14px;

border-radius:20px;

color:white;

font-size:14px;

font-weight:bold;

}

/* BUTTON */

.action-box{

display:flex;
justify-content:center;
gap:10px;

}

.edit-btn{

padding:10px 18px;

background:#2563eb;

color:white;

border-radius:12px;

text-decoration:none;

font-size:14px;

font-weight:bold;

transition:0.3s;

}

.edit-btn:hover{

background:#1d4ed8;

transform:translateY(-2px);

}

.delete-btn{

padding:10px 18px;

background:#ef4444;

color:white;

border-radius:12px;

text-decoration:none;

font-size:14px;

font-weight:bold;

transition:0.3s;

}

.delete-btn:hover{

background:#dc2626;

transform:translateY(-2px);

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
}

.search-box form{
grid-template-columns:1fr;
}

table{
display:block;
overflow:auto;
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
ChaChill
</div>

<div class="menu">

<a href="kasir_dashboard.php" class="active">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="pesanan.php">
<i class="fa-solid fa-cart-shopping"></i>
Data Pesanan
</a>

<a href="admin_ulasan.php">
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

<div class="header">

<h1>
Dashboard Pesanan ChaChill 🥤
</h1>

<p>
Monitoring transaksi customer realtime modern
</p>

</div>

<!-- CARD -->

<div class="cards">

<div class="card">
<i class="fa-solid fa-utensils"></i>
<h2><?= $totalProduk ?></h2>
<p>Total Produk</p>
</div>

<div class="card">
<i class="fa-solid fa-cart-shopping"></i>
<h2><?= $totalPesanan ?></h2>
<p>Total Pesanan</p>
</div>

<div class="card">
<i class="fa-solid fa-box"></i>
<h2><?= $totalStok ?></h2>
<p>Total Stok</p>
</div>

<div class="card">
<i class="fa-solid fa-wallet"></i>
<h2>
Rp <?= number_format($totalOmzet,0,',','.') ?>
</h2>
<p>Total Omzet</p>
</div>

</div>

<!-- SEARCH -->

<div class="search-box">

<form>

<input
type="text"
class="search-input"
placeholder="Cari produk...">

<button class="search-btn">

<i class="fa-solid fa-magnifying-glass"></i>

Cari Produk

</button>

</form>

</div>

<!-- FORM -->

<div class="form-box">

<div class="form-title">

<i class="fa-solid fa-circle-plus"></i>

Tambah Produk

</div>

<form
method="POST"
enctype="multipart/form-data">

<div class="form-grid">

<div class="input-group">

<label>Nama Menu</label>

<input
type="text"
name="nama"
required>

</div>

<div class="input-group">

<label>Harga</label>

<input
type="number"
name="harga"
required>

</div>

<div class="input-group">

<label>Stok</label>

<input
type="number"
name="stok"
required>

</div>

<div class="input-group">

<label>Gambar Produk</label>

<input
type="file"
name="gambar"
required>

</div>

</div>

<button
type="submit"
name="tambah_produk"
class="save-btn">

<i class="fa-solid fa-floppy-disk"></i>

Simpan Produk

</button>

</form>

</div>

<!-- TABLE -->

<div class="table-box">

<div class="table-title">

Daftar Menu ChaChill

</div>

<table>

<thead>

<tr>

<th>ID</th>
<th>Gambar</th>
<th>Nama Produk</th>
<th>Harga</th>
<th>Stok</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php
while(
$row = oci_fetch_array(
$produk,
OCI_ASSOC
)
){
?>

<tr>

<td>
<?= $row['ID_PRODUK'] ?>
</td>

<td>

<?php if(!empty($row['GAMBAR'])){ ?>

<img
src="image/<?= $row['GAMBAR'] ?>"
class="produk-img">

<?php } else { ?>

<img
src="image/Thai Tea Original.jpg"
class="produk-img">

<?php } ?>

</td>

<td>
<?= $row['NAMA_PRODUK'] ?>
</td>

<td>
Rp <?= number_format($row['HARGA'],0,',','.') ?>
</td>

<td>

<span class="badge">

<?= $row['STOK'] ?>

</span>

</td>

<td>

<div class="action-box">

<a
href="edit_produk.php?id=<?= $row['ID_PRODUK'] ?>"
class="edit-btn">

<i class="fa-solid fa-pen"></i>

Edit

</a>

<a
href="kasir_dashboard.php?hapus=<?= $row['ID_PRODUK'] ?>"
class="delete-btn"

onclick="return confirm('Yakin ingin hapus produk ini?')">

<i class="fa-solid fa-trash"></i>

Hapus

</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</body>
</html>
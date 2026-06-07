<?php

session_start();
include "dbconfig.php";

/* =========================
   AMBIL ID
========================= */

$id =
$_GET['id'] ?? '';

/* =========================
   AMBIL DATA PRODUK
========================= */

$sql = "
SELECT *
FROM PRODUK
WHERE ID_PRODUK='$id'
";

$stid =
oci_parse($conn,$sql);

oci_execute($stid);

$row =
oci_fetch_array(
$stid,
OCI_ASSOC
);

/* =========================
   UPDATE PRODUK
========================= */

if(isset($_POST['update'])){

$nama =
$_POST['nama'];

$harga =
$_POST['harga'];

$stok =
$_POST['stok'];

/* =========================
   UPLOAD FOTO
========================= */

$gambar_lama =
$row['GAMBAR'];

$gambar =
$gambar_lama;

if(
isset($_FILES['gambar'])
&&
$_FILES['gambar']['name'] != ''
){

$gambar =
$_FILES['gambar']['name'];

$tmp =
$_FILES['gambar']['tmp_name'];

move_uploaded_file(
$tmp,
"image/".$gambar
);

}

/* =========================
   UPDATE DATABASE
========================= */

$sqlUpdate = "
UPDATE PRODUK
SET
NAMA_PRODUK='$nama',
HARGA='$harga',
STOK='$stok',
GAMBAR='$gambar'
WHERE ID_PRODUK='$id'
";

$update =
oci_parse(
$conn,
$sqlUpdate
);

oci_execute($update);

header(
"Location: kasir_dashboard.php"
);

exit;

}

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Produk</title>

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

.card{

width:100%;
max-width:700px;

background:white;

padding:40px;

border-radius:35px;

box-shadow:
0 20px 40px rgba(255,107,0,0.15);

}

.title{

font-size:42px;
font-weight:800;

color:#ff6b00;

margin-bottom:35px;

text-align:center;

}

.form-group{

margin-bottom:25px;

}

label{

display:block;

margin-bottom:10px;

font-weight:700;

color:#111827;

}

input{

width:100%;

height:60px;

border:
2px solid #fed7aa;

border-radius:18px;

padding:15px;

font-size:16px;

outline:none;

}

input:focus{

border-color:#ff9800;

}

.preview{

width:140px;
height:140px;

object-fit:cover;

border-radius:20px;

margin-top:15px;

border:
3px solid #fed7aa;

}

.btn{

width:100%;
height:65px;

border:none;

border-radius:20px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

font-size:18px;
font-weight:700;

cursor:pointer;

transition:0.3s;

}

.btn:hover{

transform:translateY(-4px);

}

</style>

</head>

<body>

<div class="card">

<div class="title">

Edit Produk 🧋

</div>

<form
method="POST"
enctype="multipart/form-data">

<div class="form-group">

<label>
Nama Produk
</label>

<input
type="text"
name="nama"
value="<?= $row['NAMA_PRODUK']; ?>"
required>

</div>

<div class="form-group">

<label>
Harga
</label>

<input
type="number"
name="harga"
value="<?= $row['HARGA']; ?>"
required>

</div>

<div class="form-group">

<label>
Stok
</label>

<input
type="number"
name="stok"
value="<?= $row['STOK']; ?>"
required>

</div>

<div class="form-group">

<label>
Gambar Produk
</label>

<input
type="file"
name="gambar">

<br><br>

<img
src="image/<?= $row['GAMBAR']; ?>"
class="preview">

</div>

<button
type="submit"
name="update"
class="btn">

💾 Update Produk

</button>

</form>

</div>

</body>
</html>
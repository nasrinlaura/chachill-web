<?php

session_start();
include "dbconfig.php";

/* =========================
   HAPUS ULASAN
========================= */

if(isset($_GET['hapus'])){

$id = $_GET['hapus'];

$hapus = oci_parse(
$conn,
"DELETE FROM ULASAN
WHERE ID_ULASAN = :id"
);

oci_bind_by_name(
$hapus,
":id",
$id
);

oci_execute($hapus);

header(
"Location: admin_ulasan.php"
);

}

/* =========================
   AMBIL DATA ULASAN
========================= */

$sql =
"SELECT * FROM ULASAN
ORDER BY ID_ULASAN DESC";

$stid =
oci_parse($conn,$sql);

oci_execute($stid);

?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ulasan Customer</title>

<!-- GOOGLE FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

background:#f5f7fb;

display:flex;

}

/* =========================
   SIDEBAR
========================= */

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

/* =========================
   MAIN
========================= */

.main{

margin-left:260px;

padding:35px;

width:100%;

}

/* =========================
   HEADER
========================= */

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

margin-bottom:35px;

box-shadow:
0 10px 25px rgba(0,0,0,0.1);

}

.header h1{

font-size:42px;

margin-bottom:10px;

}

.header p{

font-size:18px;

opacity:0.9;

}

/* =========================
   REVIEW CARD
========================= */

.review-card{

background:white;

padding:30px;

border-radius:25px;

margin-bottom:25px;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

transition:0.3s;

}

.review-card:hover{

transform:translateY(-4px);

}

.top{

display:flex;

justify-content:space-between;

align-items:center;

flex-wrap:wrap;

gap:20px;

margin-bottom:20px;

}

.profile{

display:flex;

align-items:center;

gap:18px;

}

.profile img{

width:70px;
height:70px;

border-radius:50%;

object-fit:cover;

border:4px solid #ff9800;

}

.profile h5{

font-size:24px;

font-weight:700;

margin-bottom:5px;

color:#111827;

}

.profile p{

font-size:14px;

color:#6b7280;

}

.star{

font-size:24px;

color:#facc15;

font-weight:bold;

}

.comment{

font-size:17px;

line-height:1.8;

color:#374151;

background:#fff7ed;

padding:20px;

border-radius:18px;

margin-bottom:20px;

}

/* =========================
   BUTTON
========================= */

.action{

display:flex;
justify-content:flex-end;

}

.delete-btn{

padding:12px 22px;

background:#ef4444;

color:white;

border-radius:14px;

text-decoration:none;

font-weight:600;

transition:0.3s;

}

.delete-btn:hover{

background:#dc2626;

transform:translateY(-2px);

}

/* =========================
   EMPTY
========================= */

.empty{

background:white;

padding:60px;

border-radius:30px;

text-align:center;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

}

.empty i{

font-size:90px;

color:#ff9800;

margin-bottom:20px;

}

.empty h2{

font-size:32px;

color:#111827;

}

/* =========================
   RESPONSIVE
========================= */

@media(max-width:900px){

.sidebar{

width:100%;
height:auto;
position:relative;

}

.main{

margin-left:0;

}

.header h1{

font-size:30px;

}

.profile{

flex-direction:column;
align-items:flex-start;

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

<a href="kasir_dashboard.php">
<i class="fa-solid fa-house"></i>
Dashboard
</a>

<a href="pesanan.php">
<i class="fa-solid fa-cart-shopping"></i>
Data Pesanan
</a>

<a href="admin_ulasan.php" class="active">
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
Customer Reviews ⭐
</h1>

<p>
Monitoring ulasan customer ChaChill realtime modern
</p>

</div>

<?php

$ada = false;

while(
$row =
oci_fetch_array(
$stid,
OCI_ASSOC
)
){

$ada = true;

?>

<!-- REVIEW CARD -->

<div class="review-card">

<div class="top">

<div class="profile">

<img
src="https://i.pravatar.cc/150?img=<?php echo rand(1,70); ?>">

<div>

<h5>

<?php echo $row['NAMA']; ?>

</h5>

<p>

<?php

if(isset($row['TANGGAL'])){

echo date(
'd M Y',
strtotime($row['TANGGAL'])
);

}

?>

</p>

</div>

</div>

<div class="star">

<?php

for($i=1;$i<=5;$i++){

if($i <= $row['RATING']){

echo "★";

}else{

echo "☆";

}

}

?>

</div>

</div>

<div class="comment">

"

<?php echo $row['KOMENTAR']; ?>

"

</div>

<div class="action">

<a
href="admin_ulasan.php?hapus=<?php echo $row['ID_ULASAN']; ?>"
class="delete-btn"

onclick="return confirm('Yakin ingin hapus ulasan ini?')">

<i class="fa-solid fa-trash"></i>

Hapus

</a>

</div>

</div>

<?php } ?>

<!-- EMPTY -->

<?php if(!$ada){ ?>

<div class="empty">

<i class="fa-solid fa-comment-dots"></i>

<h2>
Belum Ada Ulasan Customer
</h2>

</div>

<?php } ?>

</div>

</body>
</html>
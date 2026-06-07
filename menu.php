<?php

session_start();
include "dbconfig.php";

$sql = "SELECT * FROM PRODUK ORDER BY ID_PRODUK";

$stid = oci_parse($conn,$sql);

oci_execute($stid);

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Menu ChaChill</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins,sans-serif;
}

body{
background:#fff5f7;
overflow-x:hidden;
}

/* NAVBAR */

.navbar{

background:#ff4d6d;

padding:15px 0;

box-shadow:0 5px 15px rgba(0,0,0,0.1);

}

.navbar-brand{

font-size:35px;
font-weight:bold;

color:white !important;

}

.nav-link{

color:white !important;

margin-left:20px;

font-size:18px;

transition:0.3s;

}

.nav-link:hover{

transform:scale(1.1);

color:#ffe5ea !important;

}

/* HERO */

.hero{

height:45vh;

background:
linear-gradient(rgba(255,77,109,0.75),rgba(255,77,109,0.75)),
url('image/banner.jpg');

background-size:cover;
background-position:center;

display:flex;
justify-content:center;
align-items:center;

text-align:center;

color:white;

border-radius:0 0 40px 40px;

margin-bottom:60px;

}

.hero h1{

font-size:70px;
font-weight:bold;

animation:fadeUp 1s ease;

}

.hero p{

font-size:24px;

animation:fadeUp 1.5s ease;

}

/* CARD MENU */

.menu-card{

background:white;

border:none;

border-radius:28px;

overflow:hidden;

box-shadow:0 10px 25px rgba(0,0,0,0.08);

transition:0.4s;

height:100%;

display:flex;
flex-direction:column;
justify-content:space-between;

padding:20px;

}

.menu-card:hover{

transform:translateY(-10px);

box-shadow:0 18px 35px rgba(0,0,0,0.12);

}

/* GAMBAR */

.menu-image{

width:100%;
height:260px;

display:flex;
justify-content:center;
align-items:center;

overflow:hidden;

margin-bottom:15px;

}

/* FOTO */

.menu-image img{

max-width:85%;
max-height:240px;

object-fit:contain;

transition:0.4s;

}

.menu-card:hover img{

transform:scale(1.08);

}

/* BODY */

.card-body{

display:flex;
flex-direction:column;
justify-content:space-between;

height:100%;

text-align:center;

padding:10px;

}

/* NAMA */

.nama-menu{

font-size:28px;
font-weight:700;

color:#222;

height:85px;

display:flex;
align-items:center;
justify-content:center;

text-align:center;

line-height:1.3;

margin-bottom:10px;

}

/* HARGA */

.harga{

font-size:32px;
font-weight:bold;

color:#ff4d6d;

margin-bottom:25px;

}

/* QTY */

.qty-container{

display:flex;
justify-content:center;
align-items:center;

gap:15px;

margin-bottom:25px;

}

/* BUTTON + - */

.qty-btn{

width:52px;
height:52px;

border:none;

border-radius:16px;

background:#ff4d6d;
color:white;

font-size:28px;
font-weight:bold;

transition:0.3s;

box-shadow:0 6px 12px rgba(255,77,109,0.25);

}

.qty-btn:hover{

background:#ff3355;

transform:scale(1.08);

}

/* INPUT */

.qty-input{

width:75px;
height:52px;

border:none;

border-radius:16px;

background:#fff1f4;

text-align:center;

font-size:26px;
font-weight:bold;

}

/* BUTTON PESAN */

.btn-pesan{

background:#ff4d6d;
color:white;

border:none;

width:100%;
height:62px;

border-radius:18px;

font-size:22px;
font-weight:bold;

transition:0.3s;

box-shadow:0 8px 18px rgba(255,77,109,0.2);

}

.btn-pesan:hover{

background:#ff3355;

transform:translateY(-3px);

}

/* FLOAT CART */

.cart-float{

position:fixed;

bottom:30px;
right:30px;

background:#ff4d6d;
color:white;

width:75px;
height:75px;

border-radius:50%;

display:flex;
justify-content:center;
align-items:center;

font-size:30px;

box-shadow:0 10px 20px rgba(0,0,0,0.2);

z-index:999;

transition:0.3s;

text-decoration:none;

}

.cart-float:hover{

transform:scale(1.1);

color:white;

}

/* ANIMATION */

@keyframes fadeUp{

0%{
opacity:0;
transform:translateY(30px);
}

100%{
opacity:1;
transform:translateY(0);
}

}

/* RESPONSIVE */

@media(max-width:768px){

.hero h1{
font-size:42px;
}

.hero p{
font-size:18px;
}

.menu-image{
height:220px;
}

.menu-image img{
max-height:200px;
}

.nama-menu{
font-size:22px;
height:70px;
}

.harga{
font-size:28px;
}

.qty-btn{
width:45px;
height:45px;
font-size:24px;
}

.qty-input{
width:65px;
height:45px;
font-size:22px;
}

.btn-pesan{
height:55px;
font-size:18px;
}

}

</style>

</head>

<body>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-lg navbar-dark">

<div class="container">

<a class="navbar-brand" href="#">
🧋 ChaChill
</a>

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.php">
Home
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="ulasan.php">
Ulasan
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="tentang.php">
Tentang
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="keranjang.php">
Keranjang
</a>
</li>

</ul>

</div>

</nav>

<!-- HERO -->

<section class="hero">

<div>

<h1>Menu ChaChill</h1>

<p>
Minuman kekinian favorit anak muda ✨
</p>

</div>

</section>

<!-- MENU -->

<div class="container pb-5">

<div class="row g-4">

<?php while($row = oci_fetch_array($stid,OCI_ASSOC)){ ?>

<div class="col-lg-3 col-md-6"
data-aos="zoom-in">

<div class="menu-card">

<!-- FOTO -->

<div class="menu-image">

<img src="image/<?php echo $row['GAMBAR']; ?>">

</div>

<!-- BODY -->

<div class="card-body">

<!-- NAMA -->

<div class="nama-menu">

<?php echo $row['NAMA_PRODUK']; ?>

</div>

<!-- HARGA -->

<div class="harga">

Rp <?php echo number_format($row['HARGA']); ?>

</div>

<!-- FORM -->

<form action="tambah_keranjang.php" method="POST">

<input type="hidden"
name="id_produk"
value="<?php echo $row['ID_PRODUK']; ?>">

<!-- QTY -->

<div class="qty-container">

<button type="button"
class="qty-btn"
onclick="kurang(<?php echo $row['ID_PRODUK']; ?>)">
-
</button>

<input type="text"
name="qty"
id="qty<?php echo $row['ID_PRODUK']; ?>"
class="qty-input"
value="1"
readonly>

<button type="button"
class="qty-btn"
onclick="tambah(<?php echo $row['ID_PRODUK']; ?>)">
+
</button>

</div>

<!-- BUTTON -->

<button type="submit"
class="btn-pesan">

🛒 Pesan Sekarang

</button>

</form>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

<!-- FLOAT CART -->

<a href="keranjang.php"
class="cart-float">

<i class="fa-solid fa-cart-shopping"></i>

</a>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({
duration:1000
});

/* TAMBAH */

function tambah(id){

let qty =
document.getElementById('qty'+id);

qty.value = parseInt(qty.value)+1;

}

/* KURANG */

function kurang(id){

let qty =
document.getElementById('qty'+id);

if(qty.value > 1){

qty.value = parseInt(qty.value)-1;

}

}

</script>

</body>
</html>
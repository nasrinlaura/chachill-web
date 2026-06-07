<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "dbconfig.php";

/* =========================================
   CEK KONEKSI ORACLE
========================================= */

if (!$conn) {
    $e = oci_error();
    die("Koneksi Oracle gagal: " . $e['message']);
}

/* =========================================
   AMBIL DATA PRODUK
========================================= */

$sql = "
SELECT *
FROM PRODUK
ORDER BY ID_PRODUK
";

$stid = oci_parse($conn, $sql);

if (!$stid) {
    $e = oci_error($conn);
    die("OCI Parse Error: " . $e['message']);
}

$r = oci_execute($stid);

if (!$r) {
    $e = oci_error($stid);
    die("OCI Execute Error: " . $e['message']);
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

Customer Dashboard | ChaChill

</title>

<!-- BOOTSTRAP -->

<link
href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- FONT -->

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- AOS -->

<link
href="https://unpkg.com/aos@2.3.4/dist/aos.css"
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

overflow-x:hidden;

color:#111827;

}

/* SIDEBAR */

.sidebar{

position:fixed;
left:0;
top:0;

width:260px;
height:100vh;

background:
linear-gradient(
180deg,
#ff9800,
#ff6b00
);

padding:30px 20px;

box-shadow:
0 0 30px rgba(0,0,0,0.15);

z-index:999;

}

/* LOGO */

.logo{

font-size:42px;
font-weight:800;

color:white;

margin-bottom:50px;

}

.logo span{

color:#fff3d4;

}

/* MENU */

.menu{

display:flex;
align-items:center;
gap:12px;

padding:16px 18px;

border-radius:18px;

margin-bottom:15px;

text-decoration:none;

color:white;

font-weight:600;

transition:0.3s;

font-size:17px;

}

.menu:hover{

background:white;

transform:translateX(5px);

color:#ff7a00;

}

.active{

background:white;

color:#ff7a00;

}

/* CONTENT */

.content{

margin-left:260px;

}

/* HERO */

.hero{

height:50vh;

background:
linear-gradient(
rgba(255,152,0,0.75),
rgba(255,107,0,0.75)
),
url('image/banner.jpg');

background-size:cover;
background-position:center;

display:flex;
justify-content:center;
align-items:center;

text-align:center;

border-radius:0 0 40px 40px;

margin-bottom:60px;

}

/* TEXT */

.hero h1{

font-size:72px;

font-weight:800;

color:white;

margin-bottom:10px;

}

.hero p{

font-size:24px;

color:white;

}

/* CONTAINER */

.container-custom{

padding:0 35px 50px;

}

/* CARD */

.menu-card{

background:white;

border-radius:35px;

padding:25px;

height:100%;

overflow:hidden;

transition:0.4s;

box-shadow:
0 10px 30px rgba(0,0,0,0.12);

border:
2px solid #fff1e6;

}

.menu-card:hover{

transform:translateY(-10px);

box-shadow:
0 18px 40px rgba(0,0,0,0.18);

}

/* BADGE */

.badge-menu{

display:inline-block;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:8px 18px;

border-radius:30px;

font-size:14px;
font-weight:bold;

color:white;

margin-bottom:20px;

}

/* IMAGE */

.menu-image{

height:250px;

display:flex;
justify-content:center;
align-items:center;

overflow:hidden;

margin-bottom:20px;

}

.menu-image img{

max-height:240px;

transition:0.4s;

}

.menu-card:hover img{

transform:scale(1.08);

}

/* NAMA */

.nama-menu{

font-size:28px;

font-weight:700;

color:#111827;

text-align:center;

margin-bottom:10px;

min-height:80px;

display:flex;
justify-content:center;
align-items:center;

}

/* HARGA */

.harga{

font-size:34px;

font-weight:800;

text-align:center;

color:#ff6b00;

margin-bottom:20px;

}

/* STOK */

.stok{

text-align:center;

margin-bottom:15px;

font-weight:700;

font-size:17px;

color:#16a34a;

}

.habis{

text-align:center;

margin-bottom:20px;

font-weight:700;

font-size:18px;

color:#ef4444;

}

/* QTY */

.qty-container{

display:flex;
justify-content:center;
align-items:center;

gap:15px;

margin-bottom:25px;

}

.qty-btn{

width:50px;
height:50px;

border:none;

border-radius:16px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

font-size:28px;

font-weight:bold;

transition:0.3s;

cursor:pointer;

}

.qty-btn:hover{

transform:scale(1.08);

}

.qty-input{

width:75px;
height:50px;

border:none;

border-radius:16px;

background:#fff7ed;

color:#111827;

font-size:24px;
font-weight:bold;

text-align:center;

}

/* BUTTON */

.btn-pesan{

width:100%;

height:60px;

border:none;

border-radius:18px;

font-size:20px;

font-weight:700;

color:white;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

transition:0.3s;

cursor:pointer;

}

.btn-pesan:hover{

transform:translateY(-3px);

}

.btn-disabled{

background:#94a3b8;

cursor:not-allowed;

}

/* FLOAT CART */

.cart-float{

position:fixed;

right:30px;
bottom:30px;

width:80px;
height:80px;

border-radius:50%;

display:flex;
justify-content:center;
align-items:center;

font-size:32px;

color:white;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

text-decoration:none;

box-shadow:
0 10px 30px rgba(0,0,0,0.25);

z-index:999;

animation:pulse 2s infinite;

}

.cart-float:hover{

transform:scale(1.08);

color:white;

}

/* ANIMATION */

@keyframes pulse{

0%{
transform:scale(1);
}

50%{
transform:scale(1.08);
}

100%{
transform:scale(1);
}

}

/* RESPONSIVE */

@media(max-width:900px){

.sidebar{
display:none;
}

.content{
margin-left:0;
}

.hero h1{
font-size:42px;
}

.hero p{
font-size:18px;
}

.nama-menu{
font-size:22px;
}

.harga{
font-size:28px;
}

.container-custom{
padding:20px;
}

}

</style>

</head>

<body>

<!-- SIDEBAR -->

<div class="sidebar">

<div class="logo">

🧋 Cha<span>Chill</span>

</div>

<a href="index.php"
class="menu">

🏠 Beranda

</a>

<a href="customer_dashboard.php"
class="menu active">

🧋 Home

</a>

<a href="keranjang.php"
class="menu">

🛒 Keranjang

</a>

<a href="ulasan_customer.php"
class="menu">

⭐ Ulasan

</a>

<a href="logout.php"
class="menu">

🚪 Logout

</a>

</div>

<!-- CONTENT -->

<div class="content">

<!-- HERO -->

<section class="hero">

<div>

<h1>
Menu ChaChill 🧋
</h1>

<p>
Minuman segar kekinian favorit anak muda
</p>

</div>

</section>

<!-- MENU -->

<div class="container-custom">

<div class="row g-4">

<?php while($row = oci_fetch_array($stid,OCI_ASSOC)){ ?>

<div class="col-lg-3 col-md-6"
data-aos="zoom-in">

<div class="menu-card">

<!-- BADGE -->

<div class="">


</div>

<!-- IMAGE -->

<div class="menu-image">

<img
src="image/<?php echo $row['GAMBAR']; ?>">

</div>

<!-- NAMA -->

<div class="nama-menu">

<?php echo $row['NAMA_PRODUK']; ?>

</div>

<!-- HARGA -->

<div class="harga">

Rp <?php echo number_format($row['HARGA']); ?>

</div>

<!-- FORM -->

<form
action="tambah_keranjang.php"
method="POST">

<input
type="hidden"
name="id_produk"
value="<?php echo $row['ID_PRODUK']; ?>">

<?php if($row['STOK'] > 0){ ?>

<!-- STOK -->

<div class="stok">

Stok :
<?php echo $row['STOK']; ?>

</div>

<!-- QTY -->

<div class="qty-container">

<button
type="button"
class="qty-btn"

onclick="kurang(
<?php echo $row['ID_PRODUK']; ?>
)">
-
</button>

<input
type="text"
name="qty"

id="qty<?php echo $row['ID_PRODUK']; ?>"

class="qty-input"

value="0"

readonly>

<button
type="button"
class="qty-btn"

onclick="tambah(
<?php echo $row['ID_PRODUK']; ?>,
<?php echo $row['STOK']; ?>
)">
+
</button>

</div>

<!-- BUTTON -->

<button
type="submit"
class="btn-pesan">

🛒 Pesan Sekarang

</button>

<?php } else { ?>

<!-- STOK HABIS -->

<div class="habis">

❌ Stok Habis

</div>

<button
type="button"
class="btn-pesan btn-disabled"
disabled>

❌ Tidak Tersedia

</button>

<?php } ?>

</form>

</div>

</div>

<?php } ?>

</div>

</div>

</div>

<!-- FLOAT CART -->

<a href="keranjang.php"
class="cart-float">

<i class="fa-solid fa-cart-shopping"></i>

</a>

<!-- SCRIPT -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>

AOS.init({
duration:1000
});

/* TAMBAH */

function tambah(id,stok){

let qty =
document.getElementById('qty'+id);

let current =
parseInt(qty.value);

if(current < stok){

qty.value = current + 1;

}

}

/* KURANG */

function kurang(id){

let qty =
document.getElementById('qty'+id);

let current =
parseInt(qty.value);

if(current > 1){

qty.value = current - 1;

}

}

</script>

</body>
</html>
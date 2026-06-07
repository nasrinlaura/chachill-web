<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta
name="viewport"
content="width=device-width, initial-scale=1.0">

<title>ChaChill</title>

<link
href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

html,
body{

width:100%;
overflow-x:hidden;
scroll-behavior:smooth;

background:#fff7ed;

}

/* ========================================= */
/* NAVBAR */
/* ========================================= */

.navbar{

position:fixed;

top:0;
left:0;

width:100%;
height:90px;

display:flex;
justify-content:space-between;
align-items:center;

padding:0 70px;

background:white;

z-index:999;

box-shadow:
0 4px 20px rgba(0,0,0,0.08);

}

.logo{

display:flex;
align-items:center;
gap:15px;

font-size:40px;
font-weight:800;

color:#0f172a;

}

.logo span{

color:#ff7a00;

}

.logo img{

width:55px;

}

.nav-menu{

display:flex;
align-items:center;
gap:40px;

}

.nav-menu a{

text-decoration:none;

font-size:18px;
font-weight:700;

color:#0f172a;

transition:0.3s;

position:relative;

}

.nav-menu a:hover{

color:#ff7a00;

}

.nav-menu a::after{

content:'';

position:absolute;

left:0;
bottom:-7px;

width:0%;
height:3px;

background:#ff7a00;

transition:0.3s;

border-radius:20px;

}

.nav-menu a:hover::after{

width:100%;

}

/* ========================================= */
/* HERO */
/* ========================================= */

.hero{

position:relative;

width:100%;
height:100vh;

overflow:hidden;

margin-top:90px;

}

.hero img{

width:100%;
height:100%;

object-fit:cover;

display:block;

animation:
zoomHero 15s infinite alternate;

}

.overlay{

position:absolute;

top:0;
left:0;

width:100%;
height:100%;

background:
linear-gradient(
rgba(0,0,0,0.45),
rgba(0,0,0,0.45)
);

}

.hero-content{

position:absolute;

top:50%;
left:50%;

transform:
translate(-50%,-50%);

width:100%;

padding:20px;

text-align:center;

z-index:10;

animation:
fadeUp 1.2s ease;

}

.hero-content h1{

font-size:110px;

font-weight:900;

line-height:1.1;

color:white;

margin-bottom:20px;

text-shadow:
0 10px 25px rgba(0,0,0,0.35);

}

.hero-content h1 span{

color:#ff7a00;

}

.hero-content p{

font-size:28px;

font-weight:500;

color:white;

margin-bottom:40px;

}

/* ========================================= */
/* BUTTON */
/* ========================================= */

.btn-group{

display:flex;
justify-content:center;
align-items:center;

gap:20px;

flex-wrap:wrap;

}

.btn-orange{

padding:18px 45px;

border:none;

border-radius:50px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

font-size:20px;
font-weight:700;

cursor:pointer;

transition:0.4s;

box-shadow:
0 10px 25px rgba(255,107,0,0.35);

}

.btn-orange:hover{

transform:
translateY(-5px)
scale(1.03);

}

.btn-outline{

padding:18px 45px;

border:
2px solid white;

border-radius:50px;

background:transparent;

color:white;

font-size:20px;
font-weight:700;

cursor:pointer;

transition:0.4s;

}

.btn-outline:hover{

background:white;

color:#ff7a00;

transform:
translateY(-5px)
scale(1.03);

}

/* ========================================= */
/* SECTION */
/* ========================================= */

.section{

padding:100px 7%;

}

/* ========================================= */
/* TITLE */
/* ========================================= */

.section-title{

font-size:60px;

font-weight:800;

text-align:center;

margin-bottom:20px;

color:#111827;

position:relative;

display:inline-block;

left:50%;

transform:translateX(-50%);

}

.section-title span{

color:#ff7a00;

}

.section-title::after{

content:'';

position:absolute;

left:50%;
bottom:-12px;

transform:translateX(-50%);

width:120px;
height:5px;

border-radius:50px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

}

.section-sub{

text-align:center;

font-size:20px;

line-height:1.8;

color:#64748b;

max-width:900px;

margin:auto;

margin-bottom:70px;

}

/* ========================================= */
/* ABOUT */
/* ========================================= */

.about{

background:white;

}

.about-grid{

display:grid;

grid-template-columns:
repeat(2,1fr);

gap:40px;

align-items:center;

}

.about-img img{

width:100%;

border-radius:35px;

box-shadow:
0 15px 35px rgba(0,0,0,0.12);

transition:0.5s;

}

.about-img img:hover{

transform:scale(1.03);

}

.about-text h2{

font-size:42px;

margin-bottom:20px;

color:#111827;

}

.about-text p{

font-size:18px;

line-height:2;

color:#64748b;

}

/* ========================================= */
/* MENU */
/* ========================================= */

.menu-section{

background:#fff7ed;

}

.menu-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(280px,1fr));

gap:30px;

}

.menu-card{

background:white;

border-radius:30px;

padding:25px;

text-align:center;

transition:0.4s;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

position:relative;

overflow:hidden;

}

.menu-card::before{

content:'';

position:absolute;

top:-100%;
left:-100%;

width:250%;
height:250%;

background:
linear-gradient(
rgba(255,255,255,0.2),
transparent
);

transform:rotate(25deg);

transition:0.7s;

}

.menu-card:hover::before{

top:0;
left:0;

}

.menu-card:hover{

transform:
translateY(-15px)
scale(1.02);

box-shadow:
0 20px 40px rgba(255,107,0,0.18);

}

.menu-card img{

width:100%;
height:260px;

object-fit:contain;

margin-bottom:20px;

transition:0.5s;

}

.menu-card:hover img{

transform:scale(1.08);

}

.menu-card h3{

font-size:28px;

margin-bottom:10px;

color:#111827;

}

.menu-card p{

color:#64748b;

margin-bottom:20px;

}

.price{

font-size:35px;

font-weight:800;

color:#ff7a00;

}

/* ========================================= */
/* ULASAN */
/* ========================================= */

.ulasan{

background:white;

}

.ulasan-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(320px,1fr));

gap:30px;

}

.ulasan-card{

background:#fff7ed;

padding:35px;

border-radius:30px;

text-align:center;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

transition:0.4s;

}

.ulasan-card:hover{

transform:
translateY(-12px);

box-shadow:
0 20px 40px rgba(255,107,0,0.15);

}

.ulasan-card h3{

font-size:26px;

margin-bottom:10px;

color:#111827;

}

.ulasan-card p{

font-size:16px;

line-height:1.8;

color:#64748b;

margin-bottom:15px;

}

.star{

font-size:24px;

color:#facc15;

animation:
blinkStar 1.5s infinite alternate;

}

/* ========================================= */
/* SERTIFIKAT */
/* ========================================= */

.sertifikat{

background:#fff7ed;

}

.sertifikat-grid{

display:grid;

grid-template-columns:
repeat(auto-fit,minmax(320px,1fr));

gap:35px;

}

.sertifikat-card{

background:white;

border-radius:35px;

overflow:hidden;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

transition:0.5s;

border:
3px solid #fff1e6;

}

.sertifikat-card:hover{

transform:
translateY(-15px)
scale(1.02);

box-shadow:
0 25px 50px rgba(255,107,0,0.18);

}

.sertifikat-card img{

width:100%;

height:500px;

object-fit:contain;

background:white;

padding:20px;

transition:0.5s;

}

.sertifikat-card:hover img{

transform:scale(1.05);

}

.sertifikat-body{

padding:25px;

text-align:center;

}

.sertifikat-body h3{

font-size:30px;

margin-bottom:12px;

color:#111827;

}

.sertifikat-body p{

font-size:17px;

line-height:1.8;

color:#64748b;

}

/* ========================================= */
/* FOOTER */
/* ========================================= */

.footer{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:35px;

text-align:center;

color:white;

font-size:17px;

font-weight:600;

position:relative;

overflow:hidden;

}

.footer::before{

content:'';

position:absolute;

top:-50px;
left:-50px;

width:180px;
height:180px;

background:
rgba(255,255,255,0.1);

border-radius:50%;

}

.footer::after{

content:'';

position:absolute;

bottom:-70px;
right:-70px;

width:220px;
height:220px;

background:
rgba(255,255,255,0.08);

border-radius:50%;

}

/* ========================================= */
/* ANIMATION */
/* ========================================= */

@keyframes fadeUp{

0%{

opacity:0;

transform:
translate(-50%,-40%);

}

100%{

opacity:1;

transform:
translate(-50%,-50%);

}

}

@keyframes zoomHero{

0%{
transform:scale(1);
}

100%{
transform:scale(1.08);
}

}

@keyframes blinkStar{

0%{
opacity:0.7;
}

100%{
opacity:1;
}

}

/* ========================================= */
/* RESPONSIVE */
/* ========================================= */

@media(max-width:992px){

.navbar{

padding:0 25px;

}

.hero-content h1{

font-size:70px;

}

.hero-content p{

font-size:22px;

}

.about-grid{

grid-template-columns:1fr;

}

}

@media(max-width:768px){

.navbar{

height:80px;

padding:0 20px;

}

.logo{

font-size:28px;

}

.logo img{

width:42px;

}

.nav-menu{

gap:20px;

}

.nav-menu a{

font-size:15px;

}

.hero{

margin-top:80px;

}

.hero-content h1{

font-size:48px;

}

.hero-content p{

font-size:16px;

padding:0 10px;

line-height:1.8;

}

.btn-orange,
.btn-outline{

width:100%;

max-width:320px;

font-size:17px;

padding:15px;

}

.section-title{

font-size:38px;

}

.about-text h2{

font-size:30px;

}

.sertifikat-card img{

height:320px;

}

}

</style>

</head>

<body>

<!-- NAVBAR -->

<div class="navbar">

<div class="logo">

<img src="image/foto.png">

Cha<span>Chill</span>

</div>

<div class="nav-menu">

<a href="#">
Beranda
</a>

<a href="login.php">
Login
</a>

</div>

</div>

<!-- HERO -->

<div class="hero">

<img src="image/foto.png">

<div class="overlay"></div>

<div class="hero-content">

<h1>
Fresh Drink <span>ChaChill</span>
</h1>

<p>
Minuman segar, rasa premium, momen tak terlupakan.
</p>


</div>

</div>

<!-- MENU -->

<section
class="section menu-section"
id="menu">

<h1 class="section-title">

Menu <span>Best Seller</span>

</h1>

<p class="section-sub">

Nikmati berbagai menu favorit customer ChaChill.

</p>

<div class="menu-grid">

<div class="menu-card">

<img src="image/Thai Tea Original.jpg">

<h3>
Thai Tea Original
</h3>

<p>
Minuman thai tea segar dan creamy.
</p>

<div class="price">
Rp 11.000
</div>

</div>

<div class="menu-card">

<img src="image/Green Thai Tea Original.jpg">

<h3>
Green Thai Tea
</h3>

<p>
Rasa green tea premium modern.
</p>

<div class="price">
Rp 11.000
</div>

</div>

<div class="menu-card">

<img src="image/Milo Original.jpg">

<h3>
Milo Original
</h3>

<p>
Perpaduan milo coklat premium.
</p>

<div class="price">
Rp 14.000
</div>

</div>

</div>

</section>

<!-- ULASAN -->

<section
class="section ulasan"
id="ulasan">

<h1 class="section-title">

Ulasan <span>Customer</span>

</h1>

<p class="section-sub">

Pendapat customer tentang minuman ChaChill.

</p>

<div class="ulasan-grid">

<div class="ulasan-card">

<h3>
Lala
</h3>

<p>
Minumannya enak banget,
tempatnya juga nyaman dan modern.
</p>

<div class="star">
★★★★★
</div>

</div>

<div class="ulasan-card">

<h3>
Putra
</h3>

<p>
Thai tea nya creamy,
harga murah dan kualitas premium.
</p>

<div class="star">
★★★★★
</div>

</div>

<div class="ulasan-card">

<h3>
Ceci
</h3>

<p>
Paling suka Green Thai Tea nya,
recommended banget.
</p>

<div class="star">
★★★★★
</div>

</div>

</div>

</section>

<!-- SERTIFIKAT -->

<section
class="section sertifikat"
id="sertifikat">

<h1 class="section-title">

Sertifikat <span>ChaChill</span>

</h1>

<p class="section-sub">

Bukti kualitas dan keamanan produk ChaChill.

</p>

<div class="sertifikat-grid">

<div class="sertifikat-card">

<img src="image/SFK.jpg">

<div class="sertifikat-body">

<h3>
Sertifikat Halal
</h3>

<p>
Produk ChaChill telah memenuhi
standar halal dan aman dikonsumsi.
</p>

</div>

</div>

<div class="sertifikat-card">

<img src="image/SFK1.jpg">

<div class="sertifikat-body">

<h3>
Sertifikat Kualitas
</h3>

<p>
ChaChill memiliki kualitas premium
dan bahan terbaik.
</p>

</div>

</div>

</div>

</section>

<!-- FOOTER -->

<div class="footer">

© 2026 ChaChill —
Fresh Drink Modern Premium

</div>

</body>
</html>
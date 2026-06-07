<?php
session_start();
include "dbconfig.php";
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Ulasan Customer | ChaChill</title>

<!-- BOOTSTRAP -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- FONT AWESOME -->
<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<!-- GOOGLE FONT -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

/* =========================
BODY
========================= */

body{

background:
linear-gradient(
135deg,
#fff7ed,
#ffedd5
);

min-height:100vh;

overflow-x:hidden;

color:#111827;

}

/* =========================
SIDEBAR
========================= */

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

border-right:
1px solid rgba(255,255,255,0.08);

box-shadow:
0 0 30px rgba(0,0,0,0.15);

z-index:999;

}

/* =========================
LOGO
========================= */

.logo{

font-size:42px;
font-weight:800;

color:white;

margin-bottom:50px;

}

.logo span{

color:#fff3d4;

}

/* =========================
MENU
========================= */

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

box-shadow:
0 10px 25px rgba(255,107,0,0.25);

}

.active{

background:white;

color:#ff7a00;

box-shadow:
0 10px 25px rgba(255,107,0,0.25);

}

/* =========================
CONTENT
========================= */

.content{

margin-left:260px;

padding:40px;

display:flex;
justify-content:center;
align-items:center;

min-height:100vh;

}

/* =========================
REVIEW BOX
========================= */

.review-box{

width:100%;
max-width:750px;

background:white;

padding:45px;

border-radius:35px;

border:
2px solid #fff1e6;

box-shadow:
0 15px 35px rgba(0,0,0,0.10);

}

/* =========================
TITLE
========================= */

.title{

font-size:48px;
font-weight:800;

margin-bottom:10px;

text-align:center;

color:#111827;

}

.subtitle{

text-align:center;

color:#64748b;

margin-bottom:35px;

font-size:17px;

}

/* =========================
STAR
========================= */

.star-rating{

display:flex;

flex-direction:row-reverse;

justify-content:center;

gap:12px;

margin-bottom:35px;

}

.star-rating input{

display:none;

}

.star-rating label{

font-size:48px;

color:#cbd5e1;

cursor:pointer;

transition:0.3s;

}

.star-rating label:hover,
.star-rating label:hover ~ label{

color:#facc15;

transform:scale(1.1);

}

.star-rating input:checked ~ label{

color:#facc15;

}

/* =========================
INPUT
========================= */

.form-control{

height:62px;

background:#fff7ed !important;

border:
2px solid #fed7aa !important;

border-radius:18px;

color:#111827 !important;

padding:15px;

font-size:16px;

margin-bottom:25px;

}

textarea.form-control{

height:170px;

resize:none;

padding-top:18px;

}

.form-control::placeholder{

color:#94a3b8;

}

.form-control:focus{

box-shadow:
0 0 0 3px rgba(255,152,0,0.25);

border-color:#ff9800 !important;

background:white !important;

}

/* =========================
BUTTON
========================= */

.btn-review{

width:100%;

height:68px;

border:none;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

font-size:20px;
font-weight:700;

border-radius:22px;

transition:0.3s;

box-shadow:
0 10px 20px rgba(255,107,0,0.25);

}

.btn-review:hover{

transform:translateY(-4px);

background:
linear-gradient(
135deg,
#fb923c,
#f97316
);

}

/* =========================
RESPONSIVE
========================= */

@media(max-width:900px){

.sidebar{
display:none;
}

.content{
margin-left:0;
padding:20px;
}

.review-box{
padding:25px;
}

.title{
font-size:34px;
}

.star-rating label{
font-size:36px;
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

<a href="customer_dashboard.php"
class="menu">

🏠 Home

</a>

<a href="keranjang.php"
class="menu">

🛒 Keranjang

</a>

<a href="ulasan_customer.php"
class="menu active">

⭐ Ulasan

</a>

<a href="logout.php"
class="menu">

🚪 Logout

</a>

</div>

<!-- CONTENT -->

<div class="content">

<div class="review-box">

<div class="title">

Customer Review ⭐

</div>

<div class="subtitle">

Bagikan pengalaman terbaik Anda bersama ChaChill ❤️

</div>

<!-- FORM -->

<form action="simpan_ulasan.php"
method="POST">

<!-- STAR -->

<div class="star-rating">

<input type="radio"
id="star5"
name="rating"
value="5"
required>

<label for="star5">★</label>

<input type="radio"
id="star4"
name="rating"
value="4">

<label for="star4">★</label>

<input type="radio"
id="star3"
name="rating"
value="3">

<label for="star3">★</label>

<input type="radio"
id="star2"
name="rating"
value="2">

<label for="star2">★</label>

<input type="radio"
id="star1"
name="rating"
value="1">

<label for="star1">★</label>

</div>

<!-- NAMA -->

<input type="text"
name="nama"
class="form-control"
placeholder="Masukkan Nama Anda"
required>

<!-- ULASAN -->

<textarea
name="komentar"
class="form-control"
placeholder="Tulis ulasan Anda..."
required></textarea>

<!-- BUTTON -->

<button type="submit"
class="btn-review">

<i class="fa-solid fa-paper-plane"></i>

Kirim Ulasan

</button>

</form>

</div>

</div>

<!-- BOOTSTRAP -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
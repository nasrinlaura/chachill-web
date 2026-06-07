<?php
session_start();
?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Login ChaChill</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- GOOGLE FONT -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- ICON -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{

min-height:100vh;

background:
linear-gradient(
135deg,
#fff7ed,
#ffedd5
);

display:flex;
justify-content:center;
align-items:center;

overflow-x:hidden;

padding:40px;

position:relative;

}

/* ========================= */
/* BACKGROUND */
/* ========================= */

.circle1{

position:absolute;

width:350px;
height:350px;

background:
rgba(255,152,0,0.18);

border-radius:50%;

top:-120px;
left:-120px;

filter:blur(10px);

animation:
move1 7s infinite alternate;

}

.circle2{

position:absolute;

width:300px;
height:300px;

background:
rgba(255,107,0,0.10);

border-radius:50%;

bottom:-100px;
right:-100px;

animation:
move2 7s infinite alternate;

}

/* ========================= */
/* CONTAINER */
/* ========================= */

.login-container{

width:100%;
max-width:1200px;

display:grid;

grid-template-columns:
repeat(2,1fr);

gap:40px;

position:relative;

z-index:10;

}

/* ========================= */
/* CARD */
/* ========================= */

.login-card{

background:white;

border:
2px solid #fff1e6;

border-radius:35px;

padding:50px 40px;

box-shadow:
0 20px 40px rgba(0,0,0,0.10);

transition:0.4s;

}

.login-card:hover{

transform:translateY(-8px);

}

/* ========================= */
/* LOGO */
/* ========================= */

.logo{

width:100px;
height:100px;

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

border-radius:50%;

display:flex;
justify-content:center;
align-items:center;

font-size:48px;

margin:auto;

margin-bottom:20px;

box-shadow:
0 10px 25px rgba(255,107,0,0.25);

color:white;

}

/* ========================= */
/* TITLE */
/* ========================= */

.title{

font-size:48px;

font-weight:800;

text-align:center;

color:#111827;

margin-bottom:10px;

}

.subtitle{

text-align:center;

color:#64748b;

margin-bottom:35px;

font-size:16px;

line-height:1.8;

}

/* ========================= */
/* TYPE */
/* ========================= */

.type{

text-align:center;

margin-bottom:30px;

font-size:26px;

font-weight:700;

color:#ff6b00;

}

/* ========================= */
/* LABEL */
/* ========================= */

label{

font-size:16px;

font-weight:600;

color:#111827;

margin-bottom:10px;

display:block;

}

/* ========================= */
/* INPUT */
/* ========================= */

.input-box{

position:relative;

margin-bottom:25px;

}

.input-box i{

position:absolute;

left:18px;
top:18px;

color:#94a3b8;

font-size:18px;

}

.form-control{

height:60px;

border:
2px solid #fed7aa;

border-radius:18px;

padding-left:52px;

font-size:16px;

background:#fff7ed;

color:#111827;

}

.form-control:focus{

border-color:#ff9800;

box-shadow:
0 0 0 3px rgba(255,152,0,0.20);

background:white;

}

/* ========================= */
/* BUTTON LOGIN */
/* ========================= */

.btn-login{

width:100%;

height:62px;

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

box-shadow:
0 10px 25px rgba(255,107,0,0.30);

transition:0.3s;

margin-top:10px;

}

.btn-login:hover{

transform:translateY(-4px);

background:
linear-gradient(
135deg,
#fb923c,
#f97316
);

}

/* ========================= */
/* BOTTOM TEXT */
/* ========================= */

.bottom-text{

text-align:center;

margin-top:25px;

color:#64748b;

font-size:15px;

line-height:1.8;

}

/* ========================= */
/* BUTTON KEMBALI */
/* ========================= */

.back-wrapper{

grid-column:1 / -1;

display:flex;
justify-content:center;
align-items:center;

margin-top:10px;

}

.btn-back{

display:inline-flex;
align-items:center;
justify-content:center;
gap:10px;

padding:15px 35px;

background:white;

border:
2px solid #fed7aa;

border-radius:18px;

color:#ff6b00;

text-decoration:none;

font-size:16px;

font-weight:600;

transition:0.3s;

min-width:260px;

box-shadow:
0 10px 25px rgba(255,107,0,0.10);

}

.btn-back:hover{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

color:white;

transform:translateY(-4px);

}

/* ========================= */
/* ANIMATION */
/* ========================= */

@keyframes move1{

0%{
transform:translate(0,0);
}

100%{
transform:translate(60px,50px);
}

}

@keyframes move2{

0%{
transform:translate(0,0);
}

100%{
transform:translate(-50px,-40px);
}

}

/* ========================= */
/* RESPONSIVE */
/* ========================= */

@media(max-width:992px){

.login-container{

grid-template-columns:1fr;

}

.title{

font-size:40px;

}

}

@media(max-width:768px){

body{

padding:25px;

}

.login-card{

padding:40px 25px;

}

.title{

font-size:36px;

}

.subtitle{

font-size:15px;

}

.type{

font-size:24px;

}

}

</style>

</head>

<body>

<!-- BACKGROUND -->

<div class="circle1"></div>
<div class="circle2"></div>

<!-- LOGIN CONTAINER -->

<div class="login-container">

<!-- ====================================== -->
<!-- CUSTOMER -->
<!-- ====================================== -->

<div class="login-card">

<div class="logo">

🧋

</div>

<div class="title">

ChaChill

</div>

<div class="subtitle">

Nikmati pengalaman minuman modern,
premium, dan kekinian bersama ChaChill.

</div>

<div class="type">

Customer

</div>

<div class="text-center mt-4">

<a href="customer_dashboard.php">

<button class="btn-login">

<i class="fa-solid fa-mug-hot"></i>

Masuk Sebagai Customer

</button>

</a>

</div>

<div class="bottom-text">

Nikmati minuman favoritmu
dengan tampilan modern 🍹

</div>

</div>

<!-- ====================================== -->
<!-- ADMIN -->
<!-- ====================================== -->

<div class="login-card">

<div class="logo">

💳

</div>

<div class="title">

ChaChill

</div>

<div class="subtitle">

Panel khusus admin dan kasir
untuk mengelola pesanan pelanggan.

</div>

<div class="type">

Admin / Kasir

</div>

<form action="kasir_dashboard.php"
method="POST">

<input type="hidden"
name="role"
value="kasir">

<!-- USERNAME -->

<label>

Username

</label>

<div class="input-box">

<i class="fa-solid fa-user"></i>

<input type="text"
name="username"
class="form-control"
placeholder="Masukkan Username"
required>

</div>

<!-- PASSWORD -->

<label>

Password

</label>

<div class="input-box">

<i class="fa-solid fa-lock"></i>

<input type="password"
name="password"
class="form-control"
placeholder="Masukkan Password"
required>

</div>

<button type="submit"
class="btn-login">

Login Admin

</button>

</form>

<div class="bottom-text">

Khusus admin dan kasir ChaChill

</div>

</div>

<!-- ====================================== -->
<!-- BUTTON KEMBALI -->
<!-- ====================================== -->

<div class="back-wrapper">

<a href="index.php"
class="btn-back">

<i class="fa-solid fa-arrow-left"></i>

Kembali ke Beranda

</a>

</div>

</div>

</body>
</html>
<!-- ======================================= -->
<!-- FILE : components/navbar.php FINAL -->
<!-- ======================================= -->

<nav class="navbar navbar-expand-lg fixed-top">

<div class="container">

<!-- LOGO -->

<a class="navbar-brand" href="index.php">

🧋 ChaChill

</a>

<!-- BUTTON MOBILE -->

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#navbarNav">

<span class="navbar-toggler-icon"></span>

</button>

<!-- MENU -->

<div class="collapse navbar-collapse"
id="navbarNav">

<ul class="navbar-nav ms-auto align-items-center">

<!-- LOGIN DI DEPAN -->

<li class="nav-item">

<a class="nav-link btn-login"
href="login.php">

Login

</a>

</li>

<!-- MENU -->

<li class="nav-item">

<a class="nav-link"
href="index.php">

Home

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="tentang.php">

Tentang

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="ulasan.php">

Ulasan

</a>

</li>

<li class="nav-item">

<a class="nav-link"
href="sertifikat.php">

Sertifikat

</a>

</li>

</ul>

</div>

</div>

</nav>

<style>

/* NAVBAR */

.navbar{

background:
rgba(15,23,42,0.95);

backdrop-filter:blur(12px);

padding:18px 0;

box-shadow:
0 5px 25px rgba(0,0,0,0.15);

}

/* LOGO */

.navbar-brand{

font-size:42px;

font-weight:800;

color:white !important;

}

/* MENU */

.nav-link{

color:white !important;

font-size:18px;

font-weight:600;

margin-left:20px;

transition:0.3s;

position:relative;

}

/* HOVER */

.nav-link:hover{

color:#ec4899 !important;

transform:translateY(-2px);

}

/* GARIS */

.nav-link::after{

content:'';

position:absolute;

left:0;

bottom:-5px;

width:0%;

height:3px;

background:#ec4899;

transition:0.3s;

border-radius:10px;

}

.nav-link:hover::after{

width:100%;

}

/* LOGIN BUTTON */

.btn-login{

background:
linear-gradient(
135deg,
#ec4899,
#db2777
);

padding:12px 28px !important;

border-radius:50px;

box-shadow:
0 8px 20px rgba(236,72,153,0.4);

margin-right:20px;

}

.btn-login:hover{

background:
linear-gradient(
135deg,
#f472b6,
#ec4899
);

color:white !important;

transform:translateY(-3px);

}

/* RESPONSIVE */

@media(max-width:992px){

.nav-link{

margin-left:0;

margin-top:15px;

}

.btn-login{

margin-right:0;

}

}

</style>
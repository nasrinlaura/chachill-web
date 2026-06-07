<!-- ======================================= -->
<!-- FILE : register.php FINAL FIX -->
<!-- ======================================= -->

<?php

session_start();
include "dbconfig.php";

$message = "";

/* REGISTER */

if(isset($_POST['register'])){

$username =
trim($_POST['username']);

$password =
trim($_POST['password']);

$confirm =
trim($_POST['confirm']);

$role =
"customer";

/* VALIDASI PASSWORD */

if($password != $confirm){

$message =
"Password tidak sama!";

}else{

/* CEK USERNAME */

$cek =
"SELECT * FROM USERS
WHERE USERNAME='$username'";

$s_cek =
oci_parse($conn,$cek);

oci_execute($s_cek);

$data =
oci_fetch_array($s_cek,OCI_ASSOC);

/* JIKA USERNAME SUDAH ADA */

if($data){

$message =
"Username sudah digunakan!";

}else{

/* INSERT USER */

$sql =
"INSERT INTO USERS
(
ID_USER,
USERNAME,
PASSWORD,
ROLE
)
VALUES
(
SEQ_USERS.NEXTVAL,
'$username',
'$password',
'$role'
)";

$stid =
oci_parse($conn,$sql);

$run =
oci_execute($stid);

/* SUCCESS */

if($run){

echo "

<script>

alert('Register Berhasil');

window.location='login.php';

</script>

";

exit();

}else{

$e = oci_error($stid);

$message =
"Gagal Register : ".$e['message'];

}

}

}

}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Register Customer | ChaChill</title>

<!-- BOOTSTRAP -->

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<!-- GOOGLE FONT -->

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<!-- FONT AWESOME -->

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

/* ====================================== */
/* BODY */
/* ====================================== */

body{

min-height:100vh;

display:flex;
justify-content:center;
align-items:center;

background:
linear-gradient(
135deg,
#0f172a,
#1e293b
);

padding:20px;

overflow:hidden;

}

/* ====================================== */
/* CARD */
/* ====================================== */

.register-card{

width:100%;
max-width:480px;

background:
rgba(255,255,255,0.08);

backdrop-filter:blur(18px);

border:
1px solid rgba(255,255,255,0.08);

padding:45px;

border-radius:30px;

box-shadow:
0 10px 40px rgba(0,0,0,0.25);

}

/* ====================================== */
/* LOGO */
/* ====================================== */

.logo{

text-align:center;

margin-bottom:35px;

}

.logo-icon{

width:90px;
height:90px;

border-radius:50%;

background:white;

display:flex;
justify-content:center;
align-items:center;

margin:auto;

font-size:42px;

box-shadow:
0 10px 30px rgba(0,0,0,0.2);

}

.logo h1{

font-size:42px;
font-weight:800;

color:white;

margin-top:20px;

}

/* ====================================== */
/* MESSAGE */
/* ====================================== */

.message{

background:
rgba(239,68,68,0.15);

border:
1px solid rgba(239,68,68,0.25);

padding:15px;

border-radius:15px;

margin-bottom:20px;

text-align:center;

color:#fecaca;

font-size:14px;

word-break:break-word;

}

/* ====================================== */
/* LABEL */
/* ====================================== */

.form-label{

color:white;

margin-bottom:10px;

font-weight:500;

}

/* ====================================== */
/* INPUT */
/* ====================================== */

.input-box{

position:relative;

margin-bottom:22px;

}

.input-box i{

position:absolute;

left:18px;
top:50%;

transform:translateY(-50%);

color:#64748b;

}

.form-control{

height:58px;

padding-left:50px;

border:none;

border-radius:16px;

background:
rgba(255,255,255,0.92);

box-shadow:none !important;

}

/* ====================================== */
/* BUTTON */
/* ====================================== */

.btn-register{

width:100%;

height:58px;

border:none;

border-radius:16px;

background:
linear-gradient(
135deg,
#ec4899,
#db2777
);

color:white;

font-size:18px;
font-weight:700;

transition:0.3s;

box-shadow:
0 10px 25px rgba(236,72,153,0.25);

}

.btn-register:hover{

transform:translateY(-4px);

}

/* ====================================== */
/* FOOTER */
/* ====================================== */

.footer{

text-align:center;

margin-top:25px;

color:#cbd5e1;

font-size:14px;

}

.footer a{

color:white;

font-weight:700;

text-decoration:none;

}

/* ====================================== */
/* RESPONSIVE */
/* ====================================== */

@media(max-width:500px){

.register-card{

padding:35px 25px;

}

.logo h1{

font-size:34px;

}

}

</style>

</head>

<body>

<div class="register-card">

<!-- LOGO -->

<div class="logo">

<div class="logo-icon">

🧋

</div>

<h1>

Register

</h1>

</div>

<!-- MESSAGE -->

<?php if($message != ""){ ?>

<div class="message">

<?php echo $message; ?>

</div>

<?php } ?>

<!-- FORM -->

<form method="POST">

<!-- USERNAME -->

<label class="form-label">

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

<label class="form-label">

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

<!-- CONFIRM -->

<label class="form-label">

Konfirmasi Password

</label>

<div class="input-box">

<i class="fa-solid fa-lock"></i>

<input type="password"
name="confirm"
class="form-control"
placeholder="Konfirmasi Password"
required>

</div>

<!-- BUTTON -->

<button type="submit"
name="register"
class="btn-register">

Daftar Sekarang

</button>

</form>

<!-- FOOTER -->

<div class="footer">

Sudah punya akun?

<a href="login.php">

Login

</a>

</div>

</div>

</body>
</html>
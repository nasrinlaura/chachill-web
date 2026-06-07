<?php

session_start();
include "dbconfig.php";

/* =========================
   UPDATE JUMLAH PRODUK
========================= */

if(isset($_GET['id']) && isset($_GET['aksi'])){

$id = $_GET['id'];
$aksi = $_GET['aksi'];

if(isset($_SESSION['cart'][$id])){

if($aksi == "tambah"){

$_SESSION['cart'][$id]++;

}

if($aksi == "kurang"){

$_SESSION['cart'][$id]--;

if($_SESSION['cart'][$id] <= 0){

unset($_SESSION['cart'][$id]);

}

}

}

header("Location: keranjang.php");
exit;

}

/* =========================
   HAPUS PRODUK
========================= */

if(isset($_GET['hapus'])){

$id = $_GET['hapus'];

unset($_SESSION['cart'][$id]);

header("Location: keranjang.php");
exit;

}

/* =========================
   SESSION CART
========================= */

$cart = $_SESSION['cart'] ?? [];

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Keranjang ChaChill</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
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
padding:35px;

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

padding:40px;

border-radius:30px;

color:white;

margin-bottom:35px;

box-shadow:
0 10px 30px rgba(255,107,0,0.25);

}

.header h1{

font-size:50px;
font-weight:800;

margin-bottom:10px;

color:white;

}

.header p{

color:#fff7ed;

}

/* =========================
TABLE & CHECKOUT BOX
========================= */

.table-box,
.checkout-box{

background:white;

padding:30px;

border-radius:30px;

border:
2px solid #fff1e6;

box-shadow:
0 10px 25px rgba(0,0,0,0.08);

margin-bottom:30px;

}

/* =========================
TITLE
========================= */

.section-title{

font-size:32px;
font-weight:800;

margin-bottom:25px;

color:#111827;

}

/* =========================
TABLE
========================= */

.table{

color:#111827;

}

.table th{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:20px;

font-weight:700;

color:white;

border:none;

}

.table td{

padding:20px;
vertical-align:middle;

border-color:#f1f5f9;

}

/* =========================
IMAGE
========================= */

.menu-img{

width:95px;
height:95px;

border-radius:20px;

object-fit:cover;

border:
3px solid #fff1e6;

box-shadow:
0 8px 15px rgba(0,0,0,0.1);

}

/* =========================
BUTTON QTY
========================= */

.qty-btn{

width:42px;
height:42px;

border:none;

border-radius:12px;

font-size:20px;

font-weight:800;

color:white;

transition:0.3s;

}

.qty-btn:hover{

transform:scale(1.08);

}

.minus{

background:#f59e0b;

box-shadow:
0 8px 18px rgba(245,158,11,0.35);

}

.plus{

background:#22c55e;

box-shadow:
0 8px 18px rgba(34,197,94,0.35);

}

/* =========================
DELETE BUTTON
========================= */

.delete-btn{

width:45px;
height:45px;

border:none;

border-radius:14px;

background:#ef4444;

color:white;

font-size:18px;

transition:0.3s;

box-shadow:
0 8px 18px rgba(239,68,68,0.35);

}

.delete-btn:hover{

transform:scale(1.08);

}

/* =========================
TOTAL BOX
========================= */

.total-box{

background:
linear-gradient(
135deg,
#ff9800,
#ff6b00
);

padding:40px;

border-radius:30px;

text-align:center;

color:white;

margin-bottom:35px;

box-shadow:
0 10px 25px rgba(255,107,0,0.25);

}

.total-box h2{

font-size:55px;
font-weight:800;

margin-top:10px;

color:white;

}

/* =========================
SELECT
========================= */

.custom-select{

height:60px;

border-radius:18px;

font-weight:600;

border:2px solid #fed7aa;

background:#fff7ed;

color:#111827;

}

.custom-select option{

color:black;

}

.custom-select:focus{

border:2px solid #ff9800;

box-shadow:none;

background:white;

color:#111827;

}

/* =========================
PAYMENT BOX
========================= */

.payment-box{

display:none;
margin-top:30px;

}

.payment-card{

background:#fff7ed;

padding:30px;

border-radius:25px;

border:
2px solid #fed7aa;

}

/* =========================
CHECKOUT BUTTON
========================= */

.checkout-btn{

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

font-size:22px;

font-weight:800;

margin-top:35px;

transition:0.3s;

box-shadow:
0 15px 30px rgba(255,107,0,0.35);

}

.checkout-btn:hover{

transform:translateY(-4px);

}

/* =========================
TEXT
========================= */

h1,h2,h3,h4,h5,h6{

color:#111827;

}

p{

color:#64748b;

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

.header h1{
font-size:38px;
}

.total-box h2{
font-size:40px;
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

🏠 Menu

</a>

<a href="keranjang.php"
class="menu active">

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

<!-- HEADER -->

<div class="header">

<h1>

🛒 Keranjang Belanja

</h1>

<p>

Cek pesanan dan checkout ChaChill dengan mudah

</p>

</div>

<!-- TABLE -->

<div class="table-box">

<div class="section-title">

🧺 Daftar Pesanan

</div>

<table class="table">

<thead>

<tr>

<th>Menu</th>
<th>Harga</th>
<th>Jumlah</th>
<th>Subtotal</th>
<th>Aksi</th>

</tr>

</thead>

<tbody>

<?php

$total = 0;

foreach($cart as $id => $jumlah){

$sql =
"SELECT * FROM PRODUK
WHERE ID_PRODUK='$id'";

$stid =
oci_parse($conn,$sql);

oci_execute($stid);

$row =
oci_fetch_array($stid,OCI_ASSOC);

if($row){

$subtotal =
$row['HARGA'] * $jumlah;

$total += $subtotal;

?>

<tr>

<td>

<div style="
display:flex;
align-items:center;
gap:18px;
">

<img
src="image/<?php echo $row['GAMBAR']; ?>"
class="menu-img">

<div>

<h5 style="
margin:0;
font-weight:700;
font-size:22px;
">

<?php echo $row['NAMA_PRODUK']; ?>

</h5>

<p style="
margin:0;
color:#64748b;
">

Stok :
<?php echo isset($row['STOK']) ? $row['STOK'] : '20'; ?>

</p>

</div>

</div>

</td>

<td>

<b>

Rp <?php echo number_format($row['HARGA']); ?>

</b>

</td>

<td>

<div style="
display:flex;
align-items:center;
gap:12px;
">

<!-- KURANG -->

<a href="?id=<?php echo $id; ?>&aksi=kurang">

<button
type="button"
class="qty-btn minus">

-

</button>

</a>

<!-- JUMLAH -->

<div style="
min-width:35px;
text-align:center;
font-size:22px;
font-weight:800;
">

<?php echo $jumlah; ?>

</div>

<!-- TAMBAH -->

<a href="?id=<?php echo $id; ?>&aksi=tambah">

<button
type="button"
class="qty-btn plus">

+

</button>

</a>

</div>

</td>

<td>

<b style="
color:#22c55e;
font-size:22px;
">

Rp <?php echo number_format($subtotal); ?>

</b>

</td>

<td>

<a href="?hapus=<?php echo $id; ?>">

<button class="delete-btn">

<i class="fa-solid fa-trash"></i>

</button>

</a>

</td>

</tr>

<?php }} ?>

</tbody>

</table>

</div>

<!-- TOTAL -->

<div class="total-box">

<p style="
font-size:22px;
">

Total Pembayaran

</p>

<h2>

Rp <?php echo number_format($total); ?>

</h2>

</div>

<!-- CHECKOUT -->

<div class="checkout-box">

<div style="
display:flex;
align-items:center;
gap:15px;
margin-bottom:30px;
">

<div style="
width:55px;
height:55px;

border-radius:18px;

background:
linear-gradient(
135deg,
#ec4899,
#db2777
);

display:flex;
align-items:center;
justify-content:center;

color:white;
font-size:24px;
">

💳

</div>

<div>

<h2 style="
margin:0;
font-weight:800;
color:#0f172a;
">

Checkout Pesanan

</h2>

<p style="
margin:0;
color:#64748b;
">

Selesaikan pembayaran ChaChill

</p>

</div>

</div>

<form action="checkout_sukses.php"
method="POST">

<div class="row g-4">

<!-- METODE -->

<div class="col-md-6">

<label style="
font-weight:700;
margin-bottom:10px;
display:block;
">

Metode Pembayaran

</label>

<select
name="metode"
id="metode"
class="form-select custom-select"
required
onchange="showPayment()">

<option value="">
-- Pilih Metode --
</option>

<option value="Transfer">
🏦 Transfer Bank
</option>

<option value="Ewallet">
📱 E-Wallet
</option>

<option value="QRIS">
📷 QRIS
</option>

<option value="Cash">
💵 Cash
</option>

</select>

</div>

<!-- BANK -->

<div class="col-md-6">

<label style="
font-weight:700;
margin-bottom:10px;
display:block;
">

Bank / E-Wallet

</label>

<select
name="bank"
id="bank"
class="form-select custom-select"
onchange="changeNumber()">

<option value="BCA">
BCA
</option>

<option value="BRI">
BRI
</option>

<option value="BNI">
BNI
</option>

<option value="Mandiri">
Mandiri
</option>

<option value="DANA">
DANA
</option>

<option value="OVO">
OVO
</option>

<option value="GoPay">
GoPay
</option>

</select>

</div>

</div>

<!-- PAYMENT -->

<div id="paymentInfo"
style="
margin-top:35px;
display:none;
">

<div style="
background:#f8fafc;
border-radius:25px;
padding:30px;
border:2px dashed #cbd5e1;
">

<!-- TRANSFER -->

<div id="transferBox"
class="payment-box">

<h3 style="
font-weight:800;
color:#2563eb;
margin-bottom:20px;
">

🏦 Transfer Rekening

</h3>

<div class="payment-card">

<p style="
margin:0;
color:#64748b;
font-weight:600;
">

Bank <span id="bankName">BCA</span>

</p>

<h2 id="rekening"
style="
font-weight:800;
color:#2563eb;
margin:10px 0;
">

1234567890

</h2>

<p style="
margin:0;
color:#64748b;
">

a.n ChaChill Premium Drink

</p>

</div>

</div>

<!-- EWALLET -->

<div id="ewalletBox"
class="payment-box">

<h3 style="
font-weight:800;
color:#db2777;
margin-bottom:20px;
">

📱 Pembayaran E-Wallet

</h3>

<div class="payment-card">

<p style="
margin:0;
color:#64748b;
font-weight:600;
">

E-Wallet <span id="ewalletName">DANA</span>

</p>

<h2 id="ewalletNumber"
style="
font-weight:800;
color:#db2777;
margin:10px 0;
">

082174306895

</h2>

<p style="
margin:0;
color:#64748b;
">

ChaChill Official Payment

</p>

</div>

</div>

<!-- QRIS -->

<div id="qrisBox"
class="payment-box"
style="
text-align:center;
">

<h3 style="
font-weight:800;
margin-bottom:20px;
color:#0f172a;
">

📷 Scan QRIS ChaChill

</h3>

<img
src="image/qris.png"
style="
width:280px;
max-width:100%;
border-radius:20px;
box-shadow:
0 10px 25px rgba(0,0,0,0.1);
">

<p style="
margin-top:15px;
color:#64748b;
">

Scan QR untuk pembayaran digital

</p>

</div>

<!-- CASH -->

<div id="cashBox"
class="payment-box">

<div style="
background:#ecfdf5;
padding:25px;
border-radius:20px;
border:2px solid #86efac;
">

<h3 style="
font-weight:800;
color:#16a34a;
margin-bottom:10px;
">

💵 Pembayaran Cash

</h3>

<p style="
margin:0;
font-size:17px;
color:#166534;
">

Silakan lakukan pembayaran langsung di kasir ChaChill.

</p>

</div>

</div>

</div>

</div>

<!-- BUTTON -->

<button
type="submit"
class="checkout-btn">

<i class="fa-solid fa-circle-check"></i>

Checkout Sekarang

</button>

</form>

</div>

</div>

<!-- SCRIPT -->

<script>

function showPayment(){

let metode =
document.getElementById("metode").value;

document.getElementById("paymentInfo").style.display="block";

document.getElementById("transferBox").style.display="none";

document.getElementById("ewalletBox").style.display="none";

document.getElementById("qrisBox").style.display="none";

document.getElementById("cashBox").style.display="none";

if(metode=="Transfer"){

document.getElementById("transferBox").style.display="block";

}

if(metode=="Ewallet"){

document.getElementById("ewalletBox").style.display="block";

}

if(metode=="QRIS"){

document.getElementById("qrisBox").style.display="block";

}

if(metode=="Cash"){

document.getElementById("cashBox").style.display="block";

}

changeNumber();

}

function changeNumber(){

let bank =
document.getElementById("bank").value;

document.getElementById("bankName").innerHTML = bank;

document.getElementById("ewalletName").innerHTML = bank;

let rekening = "";

if(bank=="BCA"){
rekening = "1234567890";
}

if(bank=="BRI"){
rekening = "9876543210";
}

if(bank=="BNI"){
rekening = "1122334455";
}

if(bank=="Mandiri"){
rekening = "5566778899";
}

if(bank=="DANA"){
rekening = "082174306895";
}

if(bank=="OVO"){
rekening = "082174306895";
}

if(bank=="GoPay"){
rekening = "082174306895";
}

document.getElementById("rekening").innerHTML = rekening;

document.getElementById("ewalletNumber").innerHTML = rekening;

}

</script>

</body>
</html>
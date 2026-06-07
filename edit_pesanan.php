<!-- ======================================= -->
<!-- FILE : edit_pesanan.php -->
<!-- ======================================= -->

<?php

include "dbconfig.php";

$id = $_GET['id'];

/* AMBIL DATA */

$sql =
"SELECT * FROM PESANAN
WHERE ID_PESANAN='$id'";

$parse =
oci_parse($conn,$sql);

oci_execute($parse);

$data =
oci_fetch_array($parse,OCI_ASSOC);

/* UPDATE */

if(isset($_POST['update'])){

$nama =
$_POST['nama'];

$total =
$_POST['total'];

$status =
$_POST['status'];

$update =
"UPDATE PESANAN SET

NAMA_CUSTOMER='$nama',
TOTAL='$total',
STATUS='$status'

WHERE ID_PESANAN='$id'";

$u =
oci_parse($conn,$update);

oci_execute($u);

header("Location: kasir_dashboard.php");

}

?>

<!DOCTYPE html>
<html lang="id">
<head>

<meta charset="UTF-8">

<meta name="viewport"
content="width=device-width, initial-scale=1.0">

<title>Edit Pesanan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
rel="stylesheet">

<link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap"
rel="stylesheet">

<style>

*{
font-family:'Poppins',sans-serif;
}

body{

background:
linear-gradient(
135deg,
#0f172a,
#1e293b
);

height:100vh;

display:flex;
justify-content:center;
align-items:center;

}

/* CARD */

.card-edit{

width:500px;

background:
rgba(255,255,255,0.08);

backdrop-filter:blur(20px);

padding:40px;

border-radius:35px;

box-shadow:
0 15px 35px rgba(0,0,0,0.3);

color:white;

}

/* TITLE */

.title{

font-size:38px;

font-weight:800;

text-align:center;

margin-bottom:30px;

}

/* INPUT */

.form-control,
.form-select{

height:55px;

border:none;

border-radius:18px;

margin-bottom:20px;

}

/* BUTTON */

.btn-save{

width:100%;

height:55px;

border:none;

border-radius:18px;

font-size:18px;

font-weight:700;

color:white;

background:
linear-gradient(
135deg,
#ec4899,
#db2777
);

transition:0.3s;

}

.btn-save:hover{

transform:translateY(-3px);

}

</style>

</head>

<body>

<div class="card-edit">

<div class="title">

✏️ Edit Pesanan

</div>

<form method="POST">

<input type="text"
name="nama"
class="form-control"
value="<?php echo $data['NAMA_CUSTOMER']; ?>"
required>

<input type="number"
name="total"
class="form-control"
value="<?php echo $data['TOTAL']; ?>"
required>

<select name="status"
class="form-select">

<option value="Menunggu"
<?php if($data['STATUS']=="Menunggu") echo "selected"; ?>>

Menunggu

</option>

<option value="Selesai"
<?php if($data['STATUS']=="Selesai") echo "selected"; ?>>

Selesai

</option>

</select>

<button type="submit"
name="update"
class="btn-save">

<i class="fa-solid fa-floppy-disk"></i>

Simpan Perubahan

</button>

</form>

</div>

</body>
</html>
<?php

session_start();

/* AMBIL DATA */

$id_produk = $_POST['id_produk'];
$qty       = (int) $_POST['qty'];

/* CEK SESSION */

if(!isset($_SESSION['cart'])){

    $_SESSION['cart'] = [];

}

/* JIKA PRODUK SUDAH ADA */

if(isset($_SESSION['cart'][$id_produk])){

    $_SESSION['cart'][$id_produk] += $qty;

}else{

    $_SESSION['cart'][$id_produk] = $qty;

}

/* KEMBALI */

header("Location: keranjang.php");

?>
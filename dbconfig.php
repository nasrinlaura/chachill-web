<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$username = "nasrin";
$password = "12345";
$host     = "localhost:1521/orcl";

$conn = oci_connect($username, $password, $host);

if (!$conn) {
    $e = oci_error();
    die("Koneksi Oracle gagal: " . $e['message']);
}
?>
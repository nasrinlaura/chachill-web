<?php

echo "PHP Version: " . phpversion();
echo "<br><br>";

if(function_exists('oci_connect')){
    echo "OCI8 AKTIF";
}else{
    echo "OCI8 TIDAK AKTIF";
}
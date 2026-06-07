<?php
include "dbconfig.php";

// Query mengambil data detail transaksi
$sql = "SELECT * FROM DETAIL_TRANSAKSI ORDER BY ID_DETAIL";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Detail Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Data Detail Transaksi</h2>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID Detail</th>
                <th>ID Transaksi</th>
                <th>ID Produk</th>
                <th>Jumlah</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>

        <?php
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        ?>

        <tr>
            <td><?php echo $row['ID_DETAIL']; ?></td>
            <td><?php echo $row['ID_TRANSAKSI']; ?></td>
            <td><?php echo $row['ID_PRODUK']; ?></td>
            <td><?php echo $row['JUMLAH']; ?></td>
            <td>Rp <?php echo number_format($row['SUBTOTAL']); ?></td>
        </tr>

        <?php
        }
        ?>

        </tbody>
    </table>

</div>

</body>
</html>
<?php
include "dbconfig.php";

// Query mengambil data user
$sql = "SELECT * FROM USERS ORDER BY ID_USER";
$stid = oci_parse($conn, $sql);
oci_execute($stid);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data User</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

<div class="container mt-5">
    <h2 class="text-center">Data Users</h2>

    <table class="table table-bordered table-striped mt-4">
        <thead class="table-dark">
            <tr>
                <th>ID User</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
            </tr>
        </thead>

        <tbody>

        <?php
        while ($row = oci_fetch_array($stid, OCI_ASSOC)) {
        ?>

        <tr>
            <td><?php echo $row['ID_USER']; ?></td>
            <td><?php echo $row['USERNAME']; ?></td>
            <td><?php echo $row['PASSWORD']; ?></td>
            <td><?php echo $row['ROLE']; ?></td>
        </tr>

        <?php
        }
        ?>

        </tbody>
    </table>

</div>

</body>
</html>
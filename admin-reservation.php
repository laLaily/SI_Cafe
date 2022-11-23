<?php
require_once __DIR__ . '/model/koneksi.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reservation</title>
</head>
<body>
<table>
        <th>Id Transaksi</th>
        <th>Name</th>
        <th>Date Me Please</th>
        <th>Phone</th>
        <th>Id Detail Trx</th>
        <th>Status</th>
        <th>Edit</th>
        <?php
            $conn = getConnection();
            $sql = "select * from reservationtransaction";
            $result = $conn->query($sql);

            if ($result) {
                foreach($result as $row){
                    echo '<tr>
                    <td>'. $row['rtrxid'].'</td>
                    <td>'. $row['rname'].'</td>
                    <td>'.$row['rdate'].'</td>
                    <td>'.$row['rnotelp'].'</td>
                    <td>'. $row['rdtrxid'].'</td>
                    <td>'. $row['rstatus'].'</td>
                    <td>
                    <button><a href="admin-reservation-update.php?updateid='.$row['rtrxid'].'">Ubah Status</a></button>
                    </td>
                </tr>'; 
                }
            echo "</table>";
        } else {
            echo "0 result";
        }
        $conn=null;
        ?>
    </table>
</body>
</html>
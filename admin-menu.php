<?php 
require_once __DIR__ . '/model/koneksi.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin-Menu</title>
</head>
<body>
<table>
        <th>Id</th>
        <th>Menu</th>
        <th>Kategori</th>
        <th>Stock</th>
        <th>Harga</th>
        <th>Edit</th>
        <?php
            $conn = getConnection();
            $sql = "select * from products";
            $result = $conn->query($sql);

            if ($result) {
                foreach($result as $row){
                    echo '<tr>
                    <td>'. $row['pid'].'</td>
                    <td>'. $row['pname'].'</td>
                    <td>'.$row['pcategory'].'</td>
                    <td>'.$row['pstock'].'</td>
                    <td>'. $row['pprice'].'</td>
                    <td>
                    <button><a href="admin-menu-update.php?updateid='.$row['pid'].'">Update</a></button>
                    <button><a href="admin-menu-delete.php?deleteid='.$row['pid'].'">Delete</a></button>
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
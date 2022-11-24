<?php
require_once __DIR__ . '/model/koneksi.php';
$conn = getConnection();
$id = $_GET['updateid'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $stock = $_POST["stock"];
    $price = $_POST["price"];
   
        $sql = "update products set pstock='$stock', pprice='$price' where pid=$id";
        $result = $conn->exec($sql);
        if ($result){
            header('location:admin-menu.php');
        } else {
            
        }
    }
$conn = null;    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Menu</title>
</head>
<body>
<section class="reserve">
            <div>
                <h1>Formulir Pemesanan</h1>
            </div>
            <form id="formres" method="POST">
                <label>Stock</label><br>
                <input type="number" name="stock" value="1" min="1" max="1000"><br>
                <label>Price</label><br>
                <input type="number" name="price" value="10000" min="10000" max="1000000"><br>
            </form>

            <div class="reserv-btn">
                <div class="wrapper">
                    <a href="../php/admin-menu.php">
                        <button type="submit" class="back">Kembali</button>
                    </a>
                    <a href="../php/admin-menu.php">
                    <button type="submit" class="book" form="formres">Update Menu</button>
                    </a>
                </div>
            </div>
        </section>
</body>
</html>
<?php
require_once __DIR__ . '/model/koneksi.php';
$conn = getConnection();

if (isset($_POST['add-submit'])) {

    $n = $_POST["name"];
    $c = $_POST["cat"];
    $s = $_POST["stock"];
    $pr = $_POST["price"];
    $p = $_POST["path"];

    $sql = "INSERT INTO products(pname,pcategory,pstock,pprice,ppath) values(?,?,?,?,?)";
    $result = $conn->prepare($sql);
    $result->execute([$n, $c, $s, $pr, $p]);
}
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style-admin-menu.css">
    <title>Admin-Menu</title>
</head>

<body>
    <header>
        <div class="judul">
            <h1>DATA PRODUCT</h1>
        </div>
    </header>
    <div class="all">
        <div class="kiri">
            <table>
                <th>Id</th>
                <th>Images</th>
                <th>Menu</th>
                <th>Kategori</th>
                <th>Stock</th>
                <th>Harga</th>
                <th>Edit</th>

                <?php
                $conn = getConnection();
                $sql = "select * from products";
                $result = $conn->query($sql);
                ?>

                <?php if ($result) : ?>
                    <?php foreach ($result as $row) : ?>
                        <tr>
                            <td> <?= $row['pid'] ?> </td>
                            <td> <img src="<?= $row['ppath'] ?>" alt="Gambar Menu"> </td>
                            <td> <?= $row['pname'] ?> </td>
                            <td> <?= $row['pcategory'] ?> </td>
                            <td> <?= $row['pstock'] ?> </td>
                            <td> <?= $row['pprice'] ?> </td>
                            <td>
                                <button><a href="admin-menu-update.php?updateid=<?= $row['pid'] ?>">Update</a></button>
                                <button><a href="admin-menu-delete.php?deleteid=<?= $row['pid'] ?>">Delete</a></button>
                            </td>
                        </tr>
                    <?php endforeach ?>
                <?php else : ?>
                    <?= "0 result" ?>
                <?php endif ?>
                <?= $conn = null ?>
                </table>
        </div>

        <div class="kanan">
            <form id="form" method="POST">
                <label>Menu</label><br>
                <input type="text" name="name" size="40%"><br>
                <label>Category</label><br>
                <input type="text" name="cat" size="40%"><br>
                <label>Stock</label><br>
                <input type="text" name="stock" size="40%"><br>
                <label>Price</label><br>
                <input type="text" name="price" size="40%"><br>
                <label>Path</label><br>
                <input type="text" name="path" size="40%"><br>
                <button type="submit" name="add-submit" class="book" form="form">Add Menu</button>
            </form>
        </div>
    </div>

</body>

</html>
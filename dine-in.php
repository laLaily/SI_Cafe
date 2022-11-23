<?php
require_once __DIR__ . '/model/products.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="./assets/css/templateHeader.css">
    <link rel="stylesheet" href="./assets/css/templateFooter.css">
    <style>
        .all {
            border: 2px solid red;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        .kiri {
            border: 2px solid pink;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            text-align: center;
            flex: 2;
        }

        .listMenu {
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            text-align: center;
        }

        .trx {
            border: 2px solid brown;
            flex: 1;
        }
    </style>
</head>

<body>
    <?php session_start(); ?>
    <header>
        <div class="logo">
            <a href="./landingPage.php"><img src="" alt="logo-cafe"></a>
        </div>
        <div class="judul">
            <h1>CAFE TERSERAH</h1>
        </div>
        <div class="galeri">
            <a href="">Galeri</a>
        </div>
    </header>
    <br><br>
    <main>
        <div class="all">
            <div class="kiri">
                <div class="filter">
                    Cari Berdasarkan:
                    <select name="filter" id="option">
                        <option value="...">...</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                        <option value="Dessert">Dessert</option>
                    </select>
                </div>
                <div class="listMenu" style="list-style: none;">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Id</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Price</th>
                                <th scope="col">Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (getProducts() as $row) : ?>
                                <form action="" method="post" name="addCart">
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="check" name="product" value="<?= $row['pid'] ?>">
                                        </td>
                                        <td><?= $row['pid']; ?></td>
                                        <td><?= $row['pname']; ?></td>
                                        <td><?= $row['pcategory']; ?></td>
                                        <td><?= $row['pprice']; ?></td>
                                        <td>
                                            <input type="number" class="qty-<?= $row['pid'] ?>" value="1" min="1" max="100" style="display:none" name="qty">
                                        </td>

                                        <input type="hidden" name="dpid" value="<?= $row['pid'] ?>">
                                        <input type="hidden" name="pprice" value="<?= $row['pprice'] ?>">

                                        <td>
                                            <button class="addData" type="sumbit" name="addCart" value="1">add</button>
                                        </td>
                                    </tr>
                                </form>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="trx">
                <div>
                    <a href="./dine-in.php">refresh</a>
                </div>
                <div class="listMenu" style="list-style: none;">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Qty</th>
                                <th scope="col">Harga Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (sizeof(getAllProductCart($_SESSION['dntrxid'])) != 0) : ?>
                                <?php foreach (getAllProductCart($_SESSION['dntrxid']) as $row) : ?>
                                    <form action="" method="post">
                                        <tr>
                                            <td><?= $row['pname']; ?></td>
                                            <td><?= $row['qty']; ?></td>
                                            <td><?= $row['qty_price']; ?></td>

                                            <input type="hidden" name="dntrxid" value="<?= $_SESSION['dntrxid'] ?>">
                                            <input type="hidden" name="dpid" value="<?= $row['dpid'] ?>">

                                            <td>
                                                <button type="sumbit" name="deleteCart" value="1">delete</button>
                                            </td>
                                        </tr>
                                    </form>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td><?= "cart kosong" ?></td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <br><br>
    <footer>
        <h1>CAFE TERSERAH</h1>
    </footer>

    <script>
        const btnAdd = document.getElementsByClassName('check');
        for (let add of btnAdd) {

            add.onclick = function() {
                if (add.checked == true) {
                    document.querySelector(`.qty-${add.value}`).style.display = 'inline';
                } else {
                    document.querySelector(`.qty-${add.value}`).style.display = 'none';
                }
            }
        }

        // const addBtn = document.getElementsByClassName('addData');
        // for (let btn of addBtn) {
        //     btn.onclick = (e) => {
        //         e.preventDefault();
        //     }
        // }
    </script>
</body>

</html>

<?php

require_once __DIR__ . '/model/koneksi.php';

if (isset($_POST['addDineInTrx'])) {
    insertTrx($_POST);
    $row = getIdDineinTransaction($_POST['dncustomername'], $_POST['dnsid']);
    $_SESSION['dntrxid'] = $row['dntrxid'];
    $_SESSION['dnsid'] = $_POST['dnsid'];
}

function insertTrx($data)
{
    $conn = getConnection();

    $sql = "INSERT INTO dineintransaction(dnsid,dncustomername) VALUES(?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $data["dnsid"]);
    $stmt->bindParam(2, $data["dncustomername"]);
    $stmt->execute();

    $conn = null;
}

function getIdDineinTransaction($username, $sid): array
{
    $conn = getConnection();

    $sql = "SELECT dntrxid FROM dineintransaction WHERE dncustomername=? AND dnsid=? ORDER BY dntrxdate DESC LIMIT 1;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $sid);
    $stmt->execute();
    $row = $stmt->fetch();

    $conn = null;

    return $row;
}

function getDineinTransaction($trxid)
{
    $conn = getConnection();

    $sql = "SELECT * FROM dineintransaction WHERE dntrxid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->execute();
    $row = $stmt->fetch();

    $conn = null;

    return $row;
}

if (isset($_POST['addCart'])) {
    $_SESSION["dpid"] = $_POST["dpid"];
    $_SESSION["qty"] = $_POST["qty"];
    $_SESSION["pprice"] = $_POST["pprice"] * $_POST["qty"];
    insertCart($_SESSION);
}

if (isset($_POST['deleteCart'])) {
    deleteCart($_POST);
}

function insertCart($data)
{
    $conn = getConnection();

    $product = getProductCart($data["dntrxid"], $data["dpid"]);
    $trx = getDineinTransaction($data["dntrxid"]);

    $price = $trx["totalPrice"] + $data["pprice"];

    if (sizeof($product) == 0) {
        $conn->beginTransaction();

        $sql = "INSERT INTO detail_dineintransaction VALUES(?,?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $data["dntrxid"]);
        $stmt->bindParam(2, $data["dpid"]);
        $stmt->bindParam(3, $data["qty"]);
        $stmt->bindParam(4, $data["pprice"]);
        $stmt->execute();

        $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dntrxid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $data["dntrxid"]);
        $stmt->execute();

        $conn->commit();
    } else {
        $qty = $product[0]["qty"] + $data["qty"];
        $qty_price = $product[0]["qty_price"] + $data["pprice"];

        $conn->beginTransaction();

        $sql = "UPDATE detail_dineintransaction SET qty=?, qty_price=? WHERE dtrxid=? AND dpid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $qty);
        $stmt->bindParam(2, $qty_price);
        $stmt->bindParam(3, $data["dntrxid"]);
        $stmt->bindParam(4, $data["dpid"]);
        $stmt->execute();

        $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dntrxid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $price);
        $stmt->bindParam(2, $data["dntrxid"]);
        $stmt->execute();

        $conn->commit();
    }

    $conn = null;
}

// function UpdateCart($data)
// {
//     $conn = getConnection();

//     $cart = getProductCart($data["dntrxid"], $data["dpid"]);

//     if ($cart["qty"] > 1) {
//         $qty = $cart["qty"] - 1;
//         $qty_price = $cart["qty_price"] * ($cart["qty"] - 1);

//         $conn->beginTransaction();

//         $sql = "UPDATE detail_dineintransaction SET qty=? AND qty_price=? WHERE dtrxid=? AND dpid=?;";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(1, $qty);
//         $stmt->bindParam(2, $qty_price);
//         $stmt->bindParam(3, $data["dntrxid"]);
//         $stmt->bindParam(4, $data["dpid"]);
//         $stmt->execute();

//         $trx = getDineinTransaction($data["dntrxid"]);
//         $price = $trx["totalPrice"] - $cart["qty_price"];

//         $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dntrxid=?;";
//         $stmt = $conn->prepare($sql);
//         $stmt->bindParam(1, $price);
//         $stmt->bindParam(2, $data["dntrxid"]);
//         $stmt->execute();

//         $conn->commit();
//     } else {
//         DeleteCart($data);
//     }

//     $conn = null;
// }

function deleteCart($data)
{
    $conn = getConnection();

    $cart = getProductCart($data["dntrxid"], $data["dpid"]);

    $trx = getDineinTransaction($data["dntrxid"]);
    $price = $trx["totalPrice"] - $cart[0]["qty_price"];

    $conn->beginTransaction();

    $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dntrxid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $price);
    $stmt->bindParam(2, $data["dntrxid"]);
    $stmt->execute();

    $sql = "DELETE FROM detail_dineintransaction WHERE dtrxid=? AND dpid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $data["dntrxid"]);
    $stmt->bindParam(2, $data["dpid"]);
    $stmt->execute();

    $conn->commit();

    $conn = null;
}


function getProductCart($trxid, $pid): array
{
    $conn = getConnection();
    $sql = "SELECT * FROM detail_dineintransaction WHERE dtrxid=? AND dpid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->bindParam(2, $pid);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

function getAllProductCart($trxid)
{
    $conn = getConnection();
    $sql = "SELECT d.dpid, p.pname, d.qty, d.qty_price FROM detail_dineintransaction AS d INNER JOIN dineintransaction ON dineintransaction.dntrxid = d.dtrxid INNER JOIN products AS p ON p.pid = d.dpid WHERE d.dtrxid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

<?php
require_once __DIR__ . '/model/products.php';
require_once __DIR__ . '/model/cart.php';
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
    <script>

    </script>
</head>

<body>
    <header>
        <div class="logo">
            <a href="./landingPage.html"><img src="" alt="logo-cafe"></a>
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
                    <select name="" id="option">
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
                                <th scope="col">Id</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Kategori</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach (getProducts() as $row) : ?>
                                <tr>
                                    <th scope="row"><?= $row["pid"]; ?></th>
                                    <td><?= $row["pname"]; ?></td>
                                    <td><?= $row["pcategory"]; ?></td>
                                    <td><?= $row["pprice"]; ?></td>
                                    <td><button onclick="insertData()">+</button><button onclick="deleteData()">-</button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="trx">
                <div>

                </div>
                <div class="listMenu" style="list-style: none;">
                    <table>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <br><br>
    <footer>
        <h1>CAFE TERSERAH</h1>
    </footer>
</body>

</html>
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

        .dinetrx {
            margin: 10px;
        }

        .refresh {
            text-align: right;
            margin: 10px;
        }

        .filter {
            margin: 10px;
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
                            @foreach ($products as $product)
                            <form action="" method="post" name="addCart">
                                <tr>
                                    <td>
                                        <input type="checkbox" class="check" name="product" value="{{ $product->id }}">
                                    </td>
                                    <td>{{ $product->id }}</td>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->product_category }}</td>
                                    <td>{{ $product->product_price }}</td>
                                    <td>
                                        <input type="number" class="qty-{{ $product->id }}" value="1" min="1" max="100" style="display:none" name="qty">
                                    </td>

                                    <input type="hidden" name="dpid" value="{{ $product->id }}">
                                    <input type="hidden" name="pprice" value="{{ $product->id }}">

                                    <td>
                                        <button class="addData" type="sumbit" name="addCart" value="1">add</button>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="trx">
                <div class="dinetrx">

                </div>
                <div class="refresh">
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
                            @isset($carts)
                            @foreach ($carts as $cart)
                            <form action="" method="post">
                                <tr>
                                    <td><?= $cart->product_name ?></td>
                                    <td><?= $cart->quantity ?></td>
                                    <td><?= $cart->quantity_price ?></td>

                                    <input type="hidden" name="dpid" value="{{ $cart->id }}">

                                    <td>
                                        <button type="sumbit" name="deleteCart" value="1">delete</button>
                                    </td>
                                </tr>
                            </form>
                            @endforeach
                            @endisset
                            @empty($carts)
                            <tr>
                                <td><?= "cart kosong" ?></td>
                            </tr>
                            @endempty
                        </tbody>
                    </table>
                </div>
            </div>
    </main>
    <br><br>
    <footer>
        <h1>CAFE TERSERAH</h1>
    </footer>
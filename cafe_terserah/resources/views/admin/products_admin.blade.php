<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">
    <title>Document</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: Georgia, 'Times New Roman', Times, serif;
        }

        .sidebar a,
        .sidebar li {
            list-style-type: none;
            text-decoration: none;
        }

        .product {
            margin: 10px;
            overflow-y: scroll;
            height: 450px;
            border: 2px solid #483434;
        }

        .product thead {
            background-color: #483434;
            color: #FFF3E4;
        }

        .product tbody {
            color: #483434;
        }

        body {
            background-color: #EED6C4;
        }

        .btn{
            background-color: #483434;
            color: white;
            border: 2px solid #483434;
            margin-left: 10px;
        }
        
        .btn:hover{
            background-color: white;
            border: 2px solid #483434;
            color: #483434;
        }

    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-accusoft"></span>Menu Admin</h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="/admin/dashboard" class="active"><span class="las la-igloo"></span>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="/admin/view"><span class="las la-users"></span>
                        <span>Data Admin</span></a>
                </li>
                <li>
                    <a href="/admin/dineintrx/view"><span class="las la-shopping-cart"></span>
                        <span>Data Transaksi</span></a>
                </li>
                <li>
                    <a href="/admin/reservationtrx/view"><span class="las la-plus"></span>
                        <span>Data Reservasi</span></a>
                </li>
                <li>
                    <a href="/admin/product/view"><span class="las la-hamburger"></span>
                        <span>Data Produk</span></a>
                </li>
                <li>
                    <a href="/admin/seat/view"><span class="las la-chair"></span>
                        <span>Data Seat</span></a>
                </li>
                <li>
                    <a href="/admin/dineintrx/recap"><span class="las la-shopping-bag"></span>
                        <span>Data Recap Transaction</span></a>
                </li>
                <li>
                    <a href="/admin/logout"><span class="las la-sign-out-alt"></span>
                        <span>Logout</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="las la bars"></span>
                </label>
                Data Product
            </h2>
            <h1>CAFE TERSERAH</h1>
            <div class="user-wrapper">
                <img src="bestot.JPG" width="40px" height="40px" alt="">
                <div>
                    <h4>bestot</h4>
                    <p>Super Admin</p>
                </div>
            </div>
        </header>

        <main>
            <div>
                <button class="btn " data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Add Product
                </button>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="/admin/product/create" method="post">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Product</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row mb-2">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Product Name</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="text" id="product_name" name="product_name">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Category</label>
                                        <div class="col-sm-5">
                                            <select class="form-control" name="product_category" id="product_category">
                                                <option>Chose One</option>
                                                <option value="food">Food</option>
                                                <option value="beverage">Beverage</option>
                                                <option value="dessert">Desert</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="product-price" class="col-sm-5 col-form-label">Price</label>
                                        <div class="col-sm-5">
                                            <input class="form-control" type="number" id="product_price" name="product_price" min="1000" max="1000000">
                                        </div>
                                    </div>
                                    <div class="row mb-2">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Stock</label>
                                        <div class="col-sm-5">
                                            <input type="number" value="1" min="1" max="100" name="product_stock" id="product_stock" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="product">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Delete</th>
                            <th scope="col">Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <!-- trigger modal -->
                        <tr data-bs-toggle="modal">
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->product_category }}</td>
                            <td>{{ $product->product_stock }}</td>
                            <td>{{ $product->product_price }}</td>
                            <td>
                                <form action="/admin/product/delete/{{$product->id}}" method="post">
                                    <button type="sumbit" name="deleteProduct" style="border: none; background-color: #EED6C4;">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                        </svg>
                                    </button>
                                </form>

                            </td>
                            <!-- Button trigger modal -->
                            <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$product->id}}">
                                    Update
                                </button>
                            </td>

                            <div class="modal fade" id="staticBackdrop-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <form action="/admin/product/update/process/{{$product->id}}" method="post">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Product</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-5 col-form-label">Product Price</label>
                                                    <div class="col-sm-5">
                                                        <input type="number" value="{{ $product->product_price }}" name="price" id="price">
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <label for="staticEmail" class="col-sm-5 col-form-label">Product Stock</label>
                                                    <div class="col-sm-5">
                                                        <input type="number" value="{{ $product->product_stock }}" min="1" max="100" name="stock" id="stock">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
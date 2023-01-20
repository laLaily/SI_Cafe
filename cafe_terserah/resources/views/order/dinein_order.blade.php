<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="{{ mix('css/templateHeader.css') }}">
    <link rel="stylesheet" href="{{ mix('css/templateFooter.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script>
        // function filter() {
        //     $.ajax({
        //         url: "/dinein/order/products",
        //         method: "GET",
        //         data: {
        //             "filter": $('#filter option:selected').val()
        //         },
        //         success: function(data) {
        //             $('html').html(data);
        //         }
        //     })
        // }

        // function deleteProductCart(param) {
        //     $.ajax({
        //         url: "/dinein/order/products/delete",
        //         method: "POST",
        //         data: {
        //             product_id: $('#product_id_delete_' + param).val()
        //         },
        //         success: function(data) {
        //             $('.dinein').html(data);
        //         }
        //     })
        // }

        // function insertCart(param) {
        //     $.ajax({
        //         url: "/dinein/order/products/process",
        //         method: "POST",
        //         data: {
        //             product_id: $('#product_id_insert_' + param).val(),
        //             quantity: $('#quantity').val()
        //         },
        //         success: function(data) {
        //             $('.dinein').html(data);
        //         }
        //     })
        // }
    </script>
    <style>
        footer {
            position: fixed;
            width: 100%;
            bottom: 0;
            height: 28px;
        }

        main {
            background-color: #EED6C4;
        }

        .products {
            margin: 10px;
            overflow-y: scroll;
            height: 450px;
            border: 2px solid #483434;
        }

        .products thead {
            background-color: #483434;
            color: #FFF3E4;
        }

        .products tbody {
            color: #483434;
        }

        .button {
            color: #FFF3E4;
            background-color: #6B4F4F;
            border: 1px solid #6B4F4F;
        }

        .button:hover {
            background-color: #483434;
            color: #EED6C4;
            border: 1px solid #483434;
        }

        .modal {
            color: #483434;
        }

        .modal-header {
            background-color: #EED6C4;
        }

        .modal-body {
            background-color: #FFF3E4;
        }

        .modal-footer {
            background-color: #EED6C4;
        }
    </style>
</head>

<body>
    <header>
        <div class="logo">
            <a href="/"><img src="" alt="logo-cafe"></a>
        </div>
        <div class="judul">
            <h1>CAFE TERSERAH</h1>
        </div>
        <div class="galeri">
            <a href="">Galeri</a>
        </div>
    </header>
    <main class="p-3">
        <div class="d-flex justify-content-between align-items-center mx-5 my-2">
            <form action="/dinein/order/products/filter" method="post">
                <div class="input-group" style="width: 400px;">
                    <select class="form-select" name="filter" id="filter" aria-label="Example select with button addon">
                        <option selected value="">All</option>
                        <option value="food">food</option>
                        <option value="beverage">beverage</option>
                        <option value="dessert">dessert</option>
                    </select>
                    <button class="btn button" type="submit">Filter</button>
                </div>
            </form>
            <!-- Button trigger modal -->
            <div>
                @foreach($transactions as $transaction)
                <div class="btn-group" role="group" aria-label="Basic outlined example">
                    <button type="button" class="btn btn-outline-dark" disabled>{{ $totalProduct }}/{{ $transaction->price_view }}</button>
                    <button type="button" class="btn button" data-bs-toggle="modal" data-bs-target="#cart">Cart</button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="cart" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Cart</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div>
                            @foreach($transactions as $transaction)
                            <div class="row">
                                <label for="customer_name" class="col-sm-5 col-form-label">Name</label>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control-plaintext" id="customer_name" value="{{ $transaction->customer_name }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="seat_number" class="col-sm-5 col-form-label">Seat Number</label>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control-plaintext" id="seat_number" value="{{ $transaction->seat_number }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="transaction_date" class="col-sm-5 col-form-label">Transaction Date</label>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control-plaintext" id="transaction_date" value="{{ $transaction->transaction_date }}">
                                </div>
                            </div>
                            <div class="row">
                                <label for="total_price" class="col-sm-5 col-form-label">Tax</label>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control-plaintext" id="total_price" value="10%">
                                </div>
                            </div>
                            <div class="row">
                                <label for="total_price" class="col-sm-5 col-form-label">Total Price</label>
                                <div class="col-sm-5">
                                    <input type="text" readonly class="form-control-plaintext" id="total_price" value="{{ $transaction->price_view }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Quantity Price</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @isset($carts)
                                    @foreach ($carts as $cart)
                                    <form action="/dinein/order/products/delete" method="post">
                                        <tr>
                                            <td>{{ $cart->product_name }}</td>
                                            <td>{{ $cart->quantity }}</td>
                                            <td>{{ $cart->price_view }}</td>

                                            <input type="hidden" name="product_id" id="product_id" value="{{ $cart->product_id }}">

                                            <td>
                                                <button type="sumbit" name="deleteCart" style="border: none; background-color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                    </form>
                                    @endforeach
                                    @endisset
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn button">
                            <a href="/dinein/order/submit" class="link-light text-decoration-none">Confim Order</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="products">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Category</th>
                        <th scope="col">Price</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <!-- trigger modal -->
                    <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop-all-{{$product->id}}" style="cursor: pointer;">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->product_category }}</td>
                        <td>{{ $product->price_view }}</td>

                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop-all-{{$product->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <form action="/dinein/order/products/process" method="post">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Order Quantity</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-5 col-form-label">Product Name</label>
                                                <div class="col-sm-5">
                                                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $product->product_name }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label for="staticEmail" class="col-sm-5 col-form-label">Quantity</label>
                                                <div class="col-sm-5">
                                                    <input type="number" value="1" min="1" max="100" name="quantity" id="quantity" class="form-control">
                                                </div>
                                            </div>
                                            <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn button">Add to Cart</button>
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
    <footer>
        <h1>CAFE TERSERAH</h1>
    </footer>
</body>
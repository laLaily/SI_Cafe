<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="{{ mix('css/styledashboard.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>Document</title>
    <script>
        // function filterDate() {
        //     $.ajax({
        //         url: "/admin/dineintrx/view",
        //         type: "GET",
        //         data: {
        //             "transaction_date": $('#filter').val(),
        //         },
        //         success: function(data) {
        //             $("html").html(data);
        //         }
        //     });
        // }
    </script>
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

        .transaction {
            margin: 10px;
            overflow-y: scroll;
            height: 450px;
            border: 2px solid #483434;
        }

        .transaction thead {
            background-color: #483434;
            color: #FFF3E4;
        }

        .transaction tbody {
            color: #483434;
        }

        body {
            background-color: #EED6C4;
        }
        .btn{
            background-color: #483434;
            color: white;
            border: 2px solid #483434;
            
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
                Data Transaction
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
            <div class="m-auto" style="width: 600px;">
                <form action="/admin/dineintrx/filter/process" method="post">
                    <div class="input-group">
                        <select class="form-select" name="transaction_date" id="filter" aria-label="Example select with button addon">
                            <option selected value="">All</option>
                            <option value="{{ Carbon\Carbon::now()->subMonth()->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">1 bulan terakhir</option>
                            <option value="{{ Carbon\Carbon::now()->subMonth(3)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">3 bulan terakhir</option>
                            <option value="{{ Carbon\Carbon::now()->subMonth(6)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">6 bulan terakhir</option>
                            <option value="{{ Carbon\Carbon::now()->subYear()->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">1 tahun terakhir</option>
                            <option value="{{ Carbon\Carbon::now()->subYear(2)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">2 tahun terakhir</option>
                        </select>
                        <button class="btn btn-primary" type="submit">Filter</button>
                    </div>
                </form>
                <!-- <div class="input-group">
            <select class="form-select" name="transaction_date" id="filter" aria-label="Example select with button addon">
                <option selected value="">All</option>
                <option value="{{ Carbon\Carbon::now()->subMonth()->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">1 bulan terakhir</option>
                <option value="{{ Carbon\Carbon::now()->subMonth(3)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">3 bulan terakhir</option>
                <option value="{{ Carbon\Carbon::now()->subMonth(6)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">6 bulan terakhir</option>
                <option value="{{ Carbon\Carbon::now()->subYear()->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">1 tahun terakhir</option>
                <option value="{{ Carbon\Carbon::now()->subYear(2)->subDay(Carbon\Carbon::now()->subDay()->format('d'))->format('Y-m-d') }},{{ Carbon\Carbon::now()->addDay()->format('Y-m-d') }}">2 tahun terakhir</option>
            </select>
            <button class="btn btn-primary" type="submit" onclick="filterDate()">Filter</button>
        </div> -->
            </div>
            <div class="transaction">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Date</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Seat Id</th>
                            <th scope="col">Price</th>
                            <th scope="col">Status</th>
                            <th scope="col">Updated at</th>
                            <th scope="col">Detail</th>
                            <th scope="col">Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dineinTransactions as $dinein)
                        <tr style="cursor: default;">
                            <td>{{ $dinein->id }}</td>
                            <td>{{ $dinein->customer_name }}</td>
                            <td>{{ $dinein->transaction_date }}</td>
                            <td>{{ $dinein->seat_id }}</td>
                            <td>{{ $dinein->price_view }}</td>
                            <td>{{ $dinein->status }}</td>
                            <td>{{ $dinein->updated_at }}</td>
                            <td><a href="/admin/dineintrx/view/{{$dinein->id}}" class="btn">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                    </svg>
                                </a></td>
                            <td>
                                <form action="/admin/dineintrx/update/status/{{$dinein->id}}" method="post">
                                    <button type="submit" class="btn" id="success" name="success" value="success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                            <path d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                            <path d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>

</html>
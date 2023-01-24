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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
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

        .reservation {
            margin: 10px;
            overflow-y: scroll;
            height: 450px;
            border: 2px solid #483434;
        }

        .reservation thead {
            background-color: #483434;
            color: #FFF3E4;
        }

        .reservation tbody {
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
                Data Reservation
            </h2>
            <div>
                <h2>CAFE TERSERAH</h2>
            </div>
            <div class="user-wrapper">
                <img src="bestot.JPG" width="40px" height="40px" alt="">
                <div>
                    <h4>bestot</h4>
                    <small>Super Admin</small>
                </div>
            </div>
        </header>
        <main>
            <div class="reservation">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Reservation Date</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Person</th>
                            <th scope="col">Dine In Id</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dine In</th>
                            <th scope="col">Update Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $r)
                        <!-- trigger modal -->
                        <tr data-bs-toggle="modal" style="cursor: pointer;">
                            <td>{{ $r->id }}</td>
                            <td>{{ $r->reservation_date }}</td>
                            <td>{{ $r->customer_name }}</td>
                            <td>{{ $r->total_person }}</td>
                            <td>{{ $r->dinein_id }}</td>
                            <td>{{ $r->status }}</td>
                            <td>
                                <button class="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$r->id}}">
                                    View Dine In
                                </button>

                            </td>
                            <td>
                                <button class="btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$r->id}}">
                                    Update Status
                                </button>

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
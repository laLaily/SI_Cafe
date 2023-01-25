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
    <title>Detail Reservation</title>
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

        .detailreservation {
            margin: 10px;
            overflow-y: scroll;
            height: 200px;
            border: 2px solid #483434;
        }

        .detailreservation thead {
            background-color: #483434;
            color: #FFF3E4;
        }

        .detailreservation tbody {
            color: #483434;
        }

        body {
            background-color: #EED6C4;
        }

        .reservation {
            display: grid;
            grid-template-columns: auto auto;
            gap: 20px;
        }

        .back a {
            color: #483434;
        }

        .back a svg {
            width: 25px;
            height: 25px;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <h2><span class="las la-accusoft"></span>Menu Admin</h2>
        </div>
        <div class="sidebar-menu">
            <a href="/admin/dashboard"><span class="las la-igloo"></span>
                <span>Dashboard</span></a>

            <a href="/admin/view"><span class="las la-users"></span>
                <span>Data Admin</span></a>

            <a href="/admin/dineintrx/view"><span class="las la-shopping-cart"></span>
                <span>Data Transaksi</span></a>

            <a href="/admin/reservationtrx/view" class="active"><span class="las la-plus"></span>
                <span>Data Reservasi</span></a>

            <a href="/admin/product/view"><span class="las la-hamburger"></span>
                <span>Data Produk</span></a>

            <a href="/admin/seat/view"><span class="las la-chair"></span>
                <span>Data Seat</span></a>

            <a href="/admin/dineintrx/recap"><span class="las la-shopping-bag"></span>
                <span>Data Recap Transaction</span></a>

            <a href="/admin/logout"><span class="las la-sign-out-alt"></span>
                <span>Logout</span></a>
        </div>
    </div>
    <div class="main-content">
        <header>
            <h2>
                <label for="">
                    <span class="las la bars"></span>
                </label>
                Dashboard
            </h2>
            <h1>CAFE TERSERAH</h1>
            <div class="user-wrapper">
                <img src="logo1.png" width="40px" height="40px" alt="profile">
                <div class="profile-wrapper">
                    <h4>bestot</h4>
                    <small>Super Admin</small>
                </div>
            </div>
        </header>
        <main>
            <div class="mx-4 mb-3 back">
                <a href="/admin/reservationtrx/view">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-circle" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-4.5-.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z" />
                    </svg>
                </a>
            </div>
            <div class="reservation mx-4">
                @foreach ($reservations as $reservation)
                <div class="row">
                    <label class="col-sm-5 col-form-label">Reservation Id</label>
                    <div class="col-sm-5">
                        <input type="number" readonly class="form-control-plaintext" value="{{ $reservation->rid }}">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Date</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value="{{ $reservation->reservation_date }}">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Customer</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" {{ $reservation->customer_name  }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Status</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" {{ $reservation->status  }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Dinein Id</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" {{ $reservation->did  }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Seat Number</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" {{ $reservation->seat_number  }}" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <label class="col-sm-5 col-form-label">Total Price</label>
                    <div class="col-sm-5">
                        <input type="text" readonly class="form-control-plaintext" value=" {{ $reservation->total_price  }}" class="form-control">
                    </div>
                </div>
                @endforeach
            </div>

            @isset($dineins)
            <div class="detailreservation">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Quantity Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dineins as $dinein)
                        <form>
                            <tr>
                                <td>{{ $dinein->product_name }}</td>
                                <td>{{ $dinein->quantity }}</td>
                                <td>{{ $dinein->price_view }}</td>
                            </tr>
                        </form>
                        @endforeach
                    </tbody>
                    </td>
                </table>
            </div>
            @endisset
        </main>
    </div>
</body>

</html>
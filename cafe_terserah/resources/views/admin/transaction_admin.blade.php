<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
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
</head>

<body>
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
    <div style="list-style: none;">
        <table class="table trxtbl">
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
                    <td>{{ $dinein->total_price }}</td>
                    <td>{{ $dinein->status }}</td>
                    <td>{{ $dinein->updated_at }}</td>
                    <td><a href="/admin/dineintrx/view/{{$dinein->id}}" class="btn btn-primary">view</a></td>
                    <td>
                        <form action="/admin/dineintrx/update/status/{{$dinein->id}}" method="post">
                            <button type="submit" class="btn btn-primary" id="success" name="success" value="success">
                                Succsess
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
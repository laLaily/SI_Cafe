<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Document</title>
</head>

<body>
    <div style="list-style: none;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Date</th>
                    <th scope="col">Customer Name</th>
                    <th scope="col">Seat Id</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">View Details</th>
                    <th scope="col">Update Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dineinTransactions as $dinein)
                <!-- trigger modal -->
                <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$dinein->id}}" style="cursor: pointer;">
                    <td>{{ $dinein->id }}</td>
                    <td>{{ $dinein->customer_name }}</td>
                    <td>{{ $dinein->transaction_date }}</td>
                    <td>{{ $dinein->seat_id }}</td>
                    <td>{{ $dinein->total_price }}</td>
                    <td>{{ $dinein->status }}</td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$dinein->id}}">
                            View
                        </button>
                        
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$dinein->id}}">
                            Update Status
                        </button>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>

</html>
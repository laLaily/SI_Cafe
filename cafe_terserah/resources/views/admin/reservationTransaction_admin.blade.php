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
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$r->id}}">
                            View Dine In
                        </button>
                        
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$r->id}}">
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
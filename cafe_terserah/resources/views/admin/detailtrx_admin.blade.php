<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>Detail Transaction</title>
</head>

<body>
    @foreach ($dineintrx as $a)
    <p>{{ $a }} </p>
    @endforeach
    <div>
        <form action="">
            @foreach ($dineintrx as $d)
            <div>
                <label>Id</label>
                <div>
                    <input type="number" value="{{ $d->id }}">
                </div>
            </div>

            <div>
                <label>Date</label>
                <div>
                    <input type="text" value="{{ $d->transaction_date }}">
                </div>
            </div>

            <div>
                <label>Customer</label>
                <div>
                    <input type="text" value="{{ $d->customer_name  }}" class="form-control">
                </div>
            </div>

            <div>
                <label>Seat</label>
                <div>
                    <input type="text" value="{{ $d->seat_id  }}" class="form-control">
                </div>
            </div>

            <div>
                <label>Total Price</label>
                <div>
                    <input type="text" value="{{ $d->total_price  }}" class="form-control">
                </div>
            </div>

            <div>
                <label>Status</label>
                <div>
                    <input type="text" value="{{ $d->status  }}" class="form-control">
                </div>
            </div>
    </div>
    @endforeach
    </form>
    </div>


    <div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Quantity Price</th>
                </tr>
            </thead>
            <tbody>
                @isset($detail)
                @foreach ($detail as $dinein)
                <form>
                    <tr>
                        <td>{{ $dinein->product_name }}</td>
                        <td>{{ $dinein->quantity }}</td>
                        <td>{{ $dinein->quantity_price }}</td>
                    </tr>
                </form>
                @endforeach

                @endisset
            </tbody>
            </td>
        </table>
    </div>

</body>

</html>
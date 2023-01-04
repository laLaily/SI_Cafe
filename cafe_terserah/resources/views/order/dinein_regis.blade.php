<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Dine-In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</head>

<body style="background: #EED6C4; background-size:cover">

    <div class="bg-light p-5 mx-auto rounded-4 position-absolute top-50 start-50 translate-middle" style="width: 400px;">
        <form action="/dinein/order/process" method="post">
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <h1>Order Dine-In</h1>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Name</label>
                @if(@isset($reservations))
                <input type="text" readonly disabled class="form-control" class="form-control" id="customer_name" name="customer_name" placeholder="name" value="{{ $reservations->customer_name }}">
                @else
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="name">
                @endif
            </div>
            <div class="mb-4">
                <label for="seat_id" class="form-label">Seat Number</label>
                <select class="form-select" name="seat_id" id="seat_id" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    @foreach($seats as $seat)
                    <option value="{{ $seat->id }}">{{ $seat->seat_number }}</option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class=" btn " style="width: 150px; background: #483434; color:#EED6C4" type="submit">Order</button>
            </div>
        </form>
    </div>
</body>

</html>
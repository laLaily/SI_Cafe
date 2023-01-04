<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    
</head>

<body style="background : #EED6C4; background-size:cover">

    <div class="bg-light p-5 mx-auto rounded-4 position-absolute top-50 start-50 translate-middle" style="width: 400px;">
        <form action="/reservation/order/process" method="post">
            <div class="mb-3 d-flex justify-content-center align-items-center">
                <h1>Reservation</h1>
            </div>
            <div class="mb-3">
                <label for="customer_name" class="form-label">Name</label>
                <input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="name">
            </div>
            <div class="mb-3">
                <label for="reservation_date" class="form-label">Reservation Date</label>
                <input type="datetime-local" class="form-control" id="reservation_date" name="reservation_date">
            </div>
            <div class="mb-3">
                <label for="total_person" class="form-label">Total Person</label>
                <input type="number" class="form-control" id="total_person" name="total_person" value="1" min="1" max="100">
            </div>
            <div class="d-flex justify-content-center align-items-center">
                <button class="btn" style="width: 150px;color:#EED6C4;background:#483434" type="submit">Reservation</button>
            </div>
        </form>
    </div>
</body>

</html>
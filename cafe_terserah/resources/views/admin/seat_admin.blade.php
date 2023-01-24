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
    <div>
        <button data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Add Seat
        </button>
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <form action="/admin/seat/create" method="post">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Seat</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Seat Number</label>
                                <div class="col-sm-5">
                                    <input type="text"  id="seat_number" name="seat_number">
                                </div>
                            </div>
                            <div class="row">
                                <label for="staticEmail" class="col-sm-5 col-form-label">Seat Type</label>
                                <div class="col-sm-5">
                                    <input type="text"  id="seat_type" name="seat_type">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Seat</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div style="list-style: none;">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Seat Number</th>
                    <th scope="col">Seat Type</th>
                    <th scope="col">Delete</th>
                    <th scope="col">Update</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($seats as $seat)
                <!-- trigger modal -->
                <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$seat->id}}" style="cursor: pointer;">
                    <td>{{ $seat->id }}</td>
                    <td>{{ $seat->seat_number }}</td>
                    <td>{{ $seat->seat_type }}</td>
                    <td>
                    <form action="/admin/seat/delete/{{$seat->id}}" method="post">
                        <button type="sumbit" name="deleteSeat" style="border: none; background-color: white;" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash text-danger" viewBox="0 0 16 16">
                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
                            </svg>
                        </button>
                    </form>
                    </td>
                    <td>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$seat->id}}">
                            Update
                        </button>
                    </td>
                    <div class="modal fade" id="staticBackdrop-{{$seat->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <form action="/admin/seat/update/process/{{$seat->id}}" method="post">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Seat Type</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <label for="staticEmail" class="col-sm-5 col-form-label">Seat Type</label>
                                            <div class="col-sm-5">
                                                <input type="text" value="{{ $seat->seat_type }}" name="seatType" id="seatType">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Update</button>
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
</body>

</html>
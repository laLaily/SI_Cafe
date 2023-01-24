<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <title>View Admin</title>
</head>

<body>
    <table class="table table-hover">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Username</th>
                <th scope="col">Update Password</th>
        </thead>
        <tbody>

            <!-- trigger modal -->
            <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop" style="cursor: pointer;">
                <td>{{ $admin -> id }}</td>
                <td>{{ $admin->username}}</td>
                <td>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Update
                    </button>
                </td>
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="/admin/password/check" method="post">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Admin</label>
                                        <div class="col-sm-5">
                                            <input readonly class="form-control-plaintext" type="text" name="username" id="username" value="{{$admin->username}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Last Password</label>
                                        <div class="col-sm-5">
                                            <input type="password" name="password" id="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button class="btn btn-primary" type="submit">Continue</button>
                                </div>
                            </div>
                        </div>
                    </form>
            </tr>

        </tbody>
    </table>
</body>

</html>
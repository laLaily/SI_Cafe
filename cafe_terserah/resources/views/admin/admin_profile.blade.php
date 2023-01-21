<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            @foreach ($admin as $a)
            <!-- trigger modal -->
            <tr data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$admin->id}}" style="cursor: pointer;">
                <td>{{ $a->id }}</td>
                <td>{{ $a->username}}</td>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop-{{$admin->id}}">
                    Update
                </button>
                </td>
                <div class="modal fade" id="staticBackdrop-{{$admin->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <form action="/admin/admin/update/process/{{$admin->id}}" method="post">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Password</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <label for="staticEmail" class="col-sm-5 col-form-label">Password</label>
                                        <div class="col-sm-5">
                                            <input type="text" name="password" id="password">
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
</body>

</html>
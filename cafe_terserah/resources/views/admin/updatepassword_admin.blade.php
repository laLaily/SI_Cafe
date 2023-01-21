<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="/admin/update/process" method="post">
        <div>
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Enter New Password</h1>
        </div>
        <div>
            <div class="row">
                <label for="staticEmail" class="col-sm-5 col-form-label">Admin</label>
                <div class="col-sm-5">
                    <input readonly class="form-control-plaintext" type="text" name="username" id="username" value="{{$admin->username}}">
                </div>
            </div>
            <div class="row">
                <label for="staticEmail" class="col-sm-5 col-form-label">New Password</label>
                <div class="col-sm-5">
                    <input type="password" name="password" id="password">
                </div>
            </div>
        </div>
        <div>
            <button class="btn btn-primary" type="submit">Update</button>
        </div>
    </form>
</body>

</html>
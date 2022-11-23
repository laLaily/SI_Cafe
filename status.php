<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php session_start(); ?>
    <h1><?= $_POST['status']; ?></h1>
    <?php if ($_POST['status'] == "transaction success") : ?>
        <?php session_destroy(); ?>
        <a href="./landingPage.php">back to home</a>
    <?php else : ?>
        <a href="./dine-in.php">back to cart</a>
    <?php endif; ?>
</body>

</html>
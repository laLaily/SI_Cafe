<?php
require_once __DIR__ . '/model/seat.php';
?>

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
    <form action="./dine-in.php" method="post">
        <label for="customername">Name : </label>
        <input type="text" name="dncustomername">
        <label for="seat">Seat : </label>
        <select name="dnsid" id="seatId">
            <?php foreach (getSeat() as $row) : ?>
                <option value="<?= $row['sid'] ?>"><?= $row['snumber'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" name="addDineInTrx" value="1">sumbit</button>
    </form>
</body>

</html>
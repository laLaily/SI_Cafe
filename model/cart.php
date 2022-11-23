<?php

require_once __DIR__ . '/koneksi.php';
require_once __DIR__ . '/dineintransaction.php';

if (isset($_POST['addCart'])) {
    insertCart($_POST);
}

function insertCart($data)
{
    $conn = getConnection();

    $product = getProductCart($data["dntrxid"], $data["dnpid"]);

    if (sizeof($product) == 0) {
        $conn->beginTransaction();

        $sql = "INSERT INTO detail_dineintransaction VALUES(?,?,?,?);";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $data["dntrxid"]);
        $stmt->bindParam(2, $data["dnpid"]);
        $stmt->bindParam(3, $data["qty"]);
        $stmt->bindParam(4, $data["pprice"]);
        $stmt->execute();

        $trx = getDineinTransaction($data["trxid"]);

        $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dtrxid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $trx["totalPrice"] + $data["pprice"]);
        $stmt->bindParam(2, $data["dntrxid"]);
        $stmt->execute();

        $conn->commit();
    } else {
        $conn->beginTransaction();

        $sql = "UPDATE FROM detail_dineintransaction SET qty=? AND qty_price=? WHERE dtrxid=? AND dpid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $product["qty"] + $data["qty"]);
        $stmt->bindParam(2, $product["qty_price"] + $data["pprice"]);
        $stmt->bindParam(3, $data["dntrxid"]);
        $stmt->bindParam(4, $data["dnpid"]);
        $stmt->execute();

        $trx = getDineinTransaction($data["trxid"]);

        $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dtrxid='?';";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $trx["totalPrice"] + $data["pprice"]);
        $stmt->bindParam(2, $data["dntrxid"]);
        $stmt->execute();

        $conn->commit();
    }

    $conn = null;
}

function UpdateCart($data)
{
    $conn = getConnection();

    $conn->beginTransaction();

    $cart = getProductCart($data["dntrxid"], $data["dnpid"]);

    if ($cart["qty"] > 1) {
        $sql = "UPDATE detail_dineintransaction SET qty=? AND qty_price=? WHERE dtrxid=? AND dpid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $cart["qty"] - 1);
        $stmt->bindParam(2, $cart["qty_price"] * ($cart["qty"] - 1));
        $stmt->bindParam(3, $data["dntrxid"]);
        $stmt->bindParam(4, $data["dnpid"]);
        $stmt->execute();

        $trx = getDineinTransaction($data["dntrxid"]);

        $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dtrxid=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $trx["totalPrice"] - $cart["qty_price"]);
        $stmt->bindParam(2, $data["dntrxid"]);
        $stmt->execute();

        $conn->commit();
    } else {
        DeleteCart($data);
    }

    $conn = null;
}

function DeleteCart($data)
{
    $conn = getConnection();

    $cart = getProductCart($data["dntrxid"], $data["dnpid"]);

    $conn->beginTransaction();

    $trx = getDineinTransaction($data["trxid"]);

    $sql = "UPDATE dineintransaction SET totalPrice=? WHERE dtrxid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trx["totalPrice"] - $cart["qty_price"]);
    $stmt->bindParam(2, $data["dntrxid"]);
    $stmt->execute();


    $sql = "DELETE FROM detail_dineintransaction WHERE dtrxid=? AND dpid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $data["dntrxid"]);
    $stmt->bindParam(2, $data["dnpid"]);
    $stmt->execute();

    $conn->commit();

    $conn = null;
}


function getProductCart($trxid, $pid): array
{
    $conn = getConnection();
    $sql = "SELECT * FROM detail_dineintransaction WHERE dtrxid=? AND dpid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->bindParam(2, $pid);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

function getAllProductCart($trxid)
{
    $conn = getConnection();
    $sql = "SELECT p.pname, d.qty, d.qty_price FROM detail_dineintransaction AS d INNER JOIN dineintransaction ON dineintransaction.dntrxid = d.dtrxid INNER JOIN products AS p ON p.pid = d.dpid;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

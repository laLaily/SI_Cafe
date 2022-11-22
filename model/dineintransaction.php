<?php

require_once __DIR__ . '/koneksi.php';

function insertTrx($data)
{
    $conn = getConnection();

    $sql = "INSERT INTO dineintransaction(dnsid,customername) VALUES(?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $data["dnsid"]);
    $stmt->bindParam(2, $data["customername"]);
    $stmt->execute();

    $conn = null;
}

function getIdDineinTransaction($username, $sid): array
{
    $conn = getConnection();

    $sql = "SELECT id FROM dineintransaction WHERE customername=? AND dnsid=? ORDER BY dndate DESC LIMIT 1;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $username);
    $stmt->bindParam(2, $sid);
    $stmt->execute();
    $row = $stmt->fetch();

    $conn = null;

    return $row;
}

function getDineinTransaction($trxid): array
{
    $conn = getConnection();

    $sql = "SELECT * FROM dineintransaction WHERE dntrxid=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $trxid);
    $stmt->execute();
    $row = $stmt->fetch();

    $conn = null;

    return $row;
}

<?php

require_once __DIR__ . '/koneksi.php';

session_start();

if (isset($_POST['addDineInTrx'])) {
    insertTrx($_POST);
    $row = getIdDineinTransaction($_POST['dncustomername'], $_POST['dnsid']);
    $_SESSION['dntrxid'] = $row['dntrxid'];
    $_SESSION['dnsid'] = $_POST['dnsid'];
}

function insertTrx($data)
{
    $conn = getConnection();

    $sql = "INSERT INTO dineintransaction(dnsid,dncustomername) VALUES(?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $data["dnsid"]);
    $stmt->bindParam(2, $data["dncustomername"]);
    $stmt->execute();

    $conn = null;
}

function getIdDineinTransaction($username, $sid): array
{
    $conn = getConnection();

    $sql = "SELECT dntrxid FROM dineintransaction WHERE dncustomername=? AND dnsid=? ORDER BY dntrxdate DESC LIMIT 1;";
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
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

<?php

require_once __DIR__ . '/koneksi.php';

function getProducts(): PDOStatement
{
    $conn = getConnection();
    $sql = "select * from products";
    $stat = $conn->query($sql);

    $conn=null;

    return $stat;
}

function getFilteredProducts($kategori): PDOStatement
{
    $conn = getConnection();
    $sql = "select * from products where pcategory='?'";
    $stat = $conn->prepare($sql);
    $stat->bindParam(1,$kategori);
    $stat->execute();

    $conn = null;

    return $stat;
}

function getProductById($id): PDOStatement
{
    $conn = getConnection();
    $sql = "select * from products where id='?'";
    $stat = $conn->prepare($sql);
    $stat->bindParam(1,$id);
    $stat->execute();

    $conn = null;

    return $stat;
}


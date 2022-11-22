<?php

require_once __DIR__ . '/koneksi.php';

function getProducts(): array
{
    $conn = getConnection();
    $sql = "SELECT * FROM products;";
    $stmt = $conn->query($sql);
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

function getFilteredProducts($kategori): array
{
    $conn = getConnection();
    $sql = "SELECT * FROM products WHERE pcategory=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $kategori);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

function getProductById($id): array
{
    $conn = getConnection();
    $sql = "SELECT * FROM products WHERE id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id);
    $stmt->execute();
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

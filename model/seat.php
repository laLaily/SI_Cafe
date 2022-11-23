<?php

require_once __DIR__ . '/koneksi.php';

function getSeat(): array
{
    $conn = getConnection();

    var_dump($conn);

    $sql = "SELECT * FROM seat";
    $stmt = $conn->query($sql);
    $row = $stmt->fetchAll();

    $conn = null;

    return $row;
}

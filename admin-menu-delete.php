<?php
    require_once __DIR__ . '/model/koneksi.php';

    $conn=getConnection();

    if (isset($_GET['deleteid'])){
        $id=$_GET['deleteid'];
        $sql = "delete from products where pid=$id";

        if ($conn->exec($sql)) {
            header('location:admin-menu.php');
        }else {
            
        }
    }
    $conn=null;
?>
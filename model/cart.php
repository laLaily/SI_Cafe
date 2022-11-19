<?php 

require_once __DIR__ . '/koneksi.php';

function insertTrx($data)
{
    $conn = getConnection();

    try{
        $sql = "SELECT * FROM dineintransaction WHERE customername='?' AND dnsid='?' ORDER BY dndate DESC;";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$data["username"]);
        $stmt->bindParam(2,$data["sid"]);
        $stmt->execute();

        updateCart($data);
    }catch(PDOException $e){
        insertCart($data);
    }

    $conn=null;
}

function insertCart($data)
{   
    $conn = getConnection();

    $product=getProductById($data["dnpid"]);

    $sql = "INSERT INTO dineintransaction(dnsid,customername,totalPrice) VALUES(?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$data["dnsid"]);
    $stmt->bindParam(2,$data["customername"]);
    $stmt->bindParam(3,$product["pprice"]);
    $stmt->execute();

    $trx = getDineinTransaction($data["customername"],$data["dnsid"]);

    $sql="INSERT INTO detail_dineintransaction VALUES(?,?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$trx["dntrxid"]);
    $stmt->bindParam(2,$data["dnpid"]);
    $stmt->bindParam(3,1);
    $stmt->bindParam(4,$product["pprice"]);
    $stmt->execute();    

    $conn=null;
}

function updateCart($data)
{
    $conn = getConnection();
    
    $product=getProductById($data["dnpid"]);

    $sql = "SELECT qty, qty_price detail_dineintransaction WHERE dntrxId='?' AND dnpid='?';";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$data["dtrxid"]);
    $stmt->bindParam(2,$data["dpid"]);
    $stmt->execute();
    $detail=$stmt;

    $sql = "UPDATE detail_dineintransaction SET qty='?' AND qty_price='?' WHERE dntrxId='?' AND dnpid='?';";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$detail["qty"]+1);
    $stmt->bindParam(2,($product["pprice"]*($detail["qty"]+1)));
    $stmt->bindParam(3,$data["dntrxid"]);
    $stmt->bindParam(4,$data["dnpid"]);
    $stmt->execute();

    $conn=null;
}

function DeleteCart($data)
{
    $conn = getConnection();

    $sql = "SELECT * FROM dineintransaction WHERE dntrxId='?' AND dncustomername='?';";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$data["dntrxid"]);
    $stmt->bindParam(2,$data["dncustomername"]);
    $stmt->execute();
    $trx = $stmt;
    
    if ($trx["qty"]==1) {
        $sql="DELETE FROM detail_dineintransaction WHERE dtrxid='?' AND dpid='?';";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$trx["dntrxid"]);
        $stmt->bindParam(2,$data["dnpid"]);
        $stmt->execute();
    }else{
        $sql="SELECT qty, qty_price FROM detail_dineintransaction WHERE dtrxid='?' AND dpid='?'";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$data["dntrxid"]);
        $stmt->bindParam(2,$data["dnpid"]);
        $stmt->execute();
        $data=$stmt;

        $sql="UPDATE detail_dineintransaction SET qty='?' AND qty_price='?';";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1,$data["qty"]-1);
        $stmt->bindParam(2,$data["qty_price"]);
        $stmt->execute();        
    }

    $conn=null;
}

function getDineinTransaction($username, $sid): PDOStatement
{
    $conn = getConnection();

    $sql = "SELECT * FROM dineintransaction WHERE customername='?' AND dnsid='?' ORDER BY dndate DESC LIMIT 1;";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1,$username);
    $stmt->bindParam(2,$sid);
    $stmt->execute();

    $conn=null;

    return $stmt;
}
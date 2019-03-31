<?php
   include 'dbConnection.php';
    $conn = getDatabaseConnection("practiceMid");
    $namedParameters = array();
    $sql = "SELECT * FROM mp_product WHERE 1";
    // bad because it can cause SQL injection
    //$sql = "SELECT * FROM om_product WHERE 1
    //        And productName Like '%" .$_GET['product']."%'";
    // checks whether user has typed something in the "Product" text box
    if (!empty($_GET['product'])) {
        $sql .= " AND productId = :productId";
        $namedParameters[":productId"] = $_GET['product'];
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute($namedParameters);
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
?>
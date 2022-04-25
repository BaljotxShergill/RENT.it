<?php
include("database.php");
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $stringData = "";
} else {
    $user_id = null;
    $stringData = null;
}
$order_id_to_print = $rowOrder['order_id'];
$myFile = "invoice$order_id_to_print.txt";
$fo = fopen($myFile, 'w') or die("can't open file");

$selectOrders = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE consumer_id = $user_id");
while ($rowOrder = mysqli_fetch_array($selectOrders)) {
    $rowOrderID = $rowOrder['order_id'];

    $selectCollection = mysqli_query($mysqli, "SELECT * FROM COLLECTION WHERE order_id = $rowOrderID AND collection_status LIKE '%APPROVED%'");

    while ($rowCollection = mysqli_fetch_array($selectCollection)) {
        $rowProvisionID = $rowOrder['provision_id'];
        $resultProvision = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $rowProvisionID");
        $rowProvision = mysqli_fetch_array($resultProvision);

        $rowProviderID = $rowOrder['provider_id'];
        $resultUser = mysqli_query($mysqli, "SELECT * FROM USERS WHERE user_id = $rowProviderID");
        $rowUser = mysqli_fetch_array($resultUser);

        $stringData .=
            "RENT.it\n\n" .
            date("Y/m/d") . "\n" .
            "CUSTOMER NAME: " . $rowUser['forename'] . " " . $rowUser['surname'] . "\n\n" .
            "--ORDER DETAILS--\n" .
            "ORDER ID: " . $rowOrder['order_id'] . "\n" .
            "PRODUCT NAME: " . $rowProvision['provision_title'] . "\n" .
            "REQUESTED DATE: " . $rowOrder['request_date'] . "\n\n" .
            "COLLECTION ADDRESS: \n" . $rowCollection['collection_address'] . "\n" .
            "COLLECTION DATE/TIME: " . $rowCollection['collection_datetime'] . "\n\n" .
            "RETURN IN : " . $rowOrder['unit_amount'] . " DAY/S FROM COLLECTION DATE" . "\n" .
            "TOTAL PAID: £" . $rowOrder['cost'] . "\n";
    }
}
fwrite($fo, $stringData);
fclose($fo);

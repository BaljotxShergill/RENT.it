<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="script.js"></script>
    <title>RENT.it</title>
</head>

<section class="showcase">
    <header>
        <?php
        if (!isset($_SESSION)) {
            session_start();
        }
        ?>
        <h1>RENT.it</h1>

        <div class="navbar">
            <?php
            include("navbar.php")
            ?>
        </div>
    </header>


    <body>

        <div class="form-popup" id="myForm">
            <?php
            include("login form.php");
            ?>
        </div>

        <?php
        // Connect to server/database
        include("database.php");
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = null;
        }
        ?>

        <form class="products" action="" method="post">
            <table class="tblproducts" style="font-size: 80%;">
                <h1 class="searchres">PENDING ORDERS:</h1>
                <br>
                <th>REQUEST DATE</th>
                <th>PRODUCT</th>
                <th>COLLECTION ADDRESS</th>
                <th>COLLECTION DATE/TIME</th>
                <th>FOR</th>
                <th>RETURN DATE</th>
                <th>AMOUNT</th>
                <th>COLLECTION STATUS</th>
                <th></th>
                <th></th>

                <?php
                $selectOrders = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE provider_id = $user_id");
                while ($rowOrder = mysqli_fetch_array($selectOrders)) {
                    $rowOrderID = $rowOrder['order_id'];

                    $selectCollection = mysqli_query($mysqli, "SELECT * FROM COLLECTION WHERE order_id = $rowOrderID AND collection_status LIKE '%PENDING%'");

                    while ($rowCollection = mysqli_fetch_array($selectCollection)) {
                ?>
                        <tr>
                            <td><?php echo $rowOrder['request_date']; ?></td>
                            <td>
                                <button type="submit" name="viewProduct" class="btnID" value="<?php echo $rowCollection['provision_id']; ?>">
                                    <?php echo "VIEW" ?>
                                </button>
                            </td>
                            <td><?php echo $rowCollection['collection_address']; ?></td>
                            <td><?php echo $rowCollection['collection_datetime']; ?></td>
                            <td>
                                <?php
                                if ($rowOrder['unit_amount'] > 1) {
                                    echo $rowOrder['unit_amount'] . " days";
                                } else {
                                    echo $rowOrder['unit_amount'] . " day";
                                }
                                ?>
                            </td>
                            <td>
                                <p id="returnDate">return date unvailable</p>
                                <script>
                                    collection_date = new Date("<?php echo $rowCollection['collection_datetime'] ?>");
                                    days = "<?php echo $rowOrder['unit_amount'] ?>";
                                    calculateDate(collection_date, days);
                                </script>
                            </td>
                            <td><?php echo "£" . $rowOrder['cost']; ?></td>
                            <td><?php echo $rowCollection['collection_status']; ?></td>
                            <td>
                                <button type="submit" name="approveOrder" class="btnID" style="color: green;" value="<?php echo $rowCollection['collection_id']; ?>">
                                    &#x2713;
                                </button>
                            </td>
                            <td>
                                <button type="submit" name="cancelOrder" class="btnID" style="color: red;" value="<?php echo $rowCollection['collection_id']; ?>">
                                    &#x2715;
                                </button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php
                }
                if (isset($_REQUEST['approveOrder'])) {
                    $collectionID = $_REQUEST['approveOrder'];
                } else if (isset($_REQUEST['cancelOrder'])) {
                    $collectionID = $_REQUEST['cancelOrder'];
                } else {
                    $collectionID = NULL;
                }

                if ($collectionID != NULL && isset($_REQUEST['approveOrder'])) {
                    $approveCollection  = "UPDATE COLLECTION SET collection_status = 'APPROVED' WHERE collection_id = $collectionID";
                    mysqli_query($mysqli, $approveCollection);

                    $amount = $rowOrder['unit_amount'] * $rowOrder['cost'];
                    $insertTranscation = "INSERT INTO TRANSACTION(transaction_type,amount, date_transaction, order_id) VALUES('CREDIT','$amount', NOW(),'$rowOrderID')";
                    if (mysqli_query($mysqli, $insertTranscation)) {
                        echo ("<script>window.alert('ORDER APPROVED.');</script>");
                        echo ("<script>window.location.href = 'MANAGE ACCOUNT.php';</script>");
                    }
                } elseif ($collectionID != NULL && isset($_REQUEST['cancelOrder'])) {
                    $cancelCollection = "UPDATE COLLECTION SET collection_status = 'CANCELLED' WHERE collection_id = $collectionID";
                    mysqli_query($mysqli, $cancelCollection);
                    echo ("<script>window.alert('ORDER CANCELLED.');</script>");
                    echo ("<script>window.location.href = 'MANAGE ACCOUNT.php';</script>");
                }
                ?>
            </table>
            <table class="tblOrders" style="font-size: 80%;">
                <?php
                if (isset($_REQUEST['viewProduct']) || isset($_REQUEST['viewOrder'])) {
                    if (isset($_REQUEST['viewProduct'])) {
                        $id = $_REQUEST['viewProduct'];
                ?>
                        <br>
                        <h1 class="searchres">DETAILS FOR PRODUCT ID: <?php echo $id ?></h1>
                        <th>NAME</th>
                        <th>DESCRIPTION</th>
                        <th>TYPE</th>
                        <th>COST</th>
                        <th>ADDRESS</th>
                    <?php
                    } else {
                        $id = NULL;
                    ?>
                        <script>
                            tblOrders.style.display === "none";
                        </script>
                    <?php
                    }
                    ?>
                    <?php
                    if ($id != NULL) {
                        $selectProvision = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $id");
                        while ($rowProduct = mysqli_fetch_array($selectProvision)) {
                    ?>
                            <tr>
                                <td><?php echo $rowProduct['provision_title']; ?></td>
                                <td><?php echo $rowProduct['provision_description']; ?></td>
                                <td><?php echo $rowProduct['provision_type']; ?></td>
                                <td>
                                    <?php echo "£" . $rowProduct['rate'], "  ", $rowProduct['rate_unit_type']; ?></td>
                                </td>
                                <td><?php echo $rowProduct['provision_address']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    }
                } else {
                    $id = NULL;
                    ?>
                    <script>
                        tblOrders.style.display === "none";
                    </script>
                <?php
                }
                ?>
            </table>
        </form>


    </body>
</section>


</html>
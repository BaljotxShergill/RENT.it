<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
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
        if (isset($_REQUEST['productId'])) {
            $search = $_REQUEST['productId'];
        } else {
            $search = null;
        }
        ?>

        <form class="rent-product" action="" method="post">
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $search");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="container-row">
                    <div class="container-col">
                        <div class="form-element">
                            <?php if ($row['image_url_1']) {
                            ?>
                                <?php $imageURL = 'image/' . $row["image_url_1"]; ?>
                                <img id='listimg' src="<?php echo $imageURL; ?>" alt="" />
                            <?php
                            } ?>
                        </div>

                        <div class="form-element">
                            <label for="product_title"><b>PRODUCT NAME</b></label>
                            <input type="text" name="product_title" value="<?php echo $row['provision_title']; ?>" readonly />
                        </div>

                        <div class="form-element">
                            <label for="provision_description"><b>PRODUCT DESCRIPTION</b></label>
                            <input type="text" name="provision_description" value="<?php echo $row['provision_description']; ?>" readonly />
                        </div>

                        <div class="form-element">
                            <label for="provision_price"><b>PRICE</b></label>
                            <input type="text" name="provision_price" value="<?php echo "£" . $row['rate'], "  ", $row['rate_unit_type']; ?>" readonly />
                        </div>
                    </div>
                    <div class="container-col">

                        <div class="form-element">
                            <label for="collection_date"><b>COLLECTION DATE</b></label>
                            <input type="datetime-local" placeholder="Enter date from when to start" name="collection_date" required />
                        </div>

                        <div class="selectList">
                            <label for="num_days"><b>NUMBER OF DAYS</b></label>
                            <select name="select_days" placeholder="Select number of days" onchange="calculateAmount(this.value)" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="14">14</option>
                                <option value="21">21</option>
                                <option value="30">30</option>
                            </select>
                        </div>

                        <div class="form-element">
                            <label for="cost"><b>TOTAL COST (£)</b></label>
                            <script>
                                cost_per_day = "<?php echo $row['rate']; ?>";
                            </script>
                            <input name="cost" id="cost" type="text" placeholder="Waiting for number of days" readonly />
                        </div>

                        <div class="form-element">
                            <h4 style="text-align:center ; width: 100%;">BILLING DETAILS</h4>
                        </div>

                        <div class="form-element">
                            <label for="name_on_card"><b>NAME ON THE CARD</b></label>
                            <input type="text" placeholder="Enter name on card" name="name_on_card" required />
                        </div>

                        <div class="form-element">
                            <label for="billing_address"><b>BILLING ADDRESS</b></label>
                            <input type="text" placeholder="Enter billing address" name="billing_address" required />
                        </div>

                        <div class="form-element">
                            <label for="expiry_date"><b>EXPIRY DATE</b></label>
                            <input type="date" placeholder="Enter expiry date of the card" name="expiry_date" required />
                        </div>

                        <div class="form-element">
                            <label for="card_number"><b>CARD NUMBER</b></label>
                            <input type="text" placeholder="Enter card number" name="card_number" required />
                        </div>

                        <div class="form-element">
                            <label for="cvv"><b>CVV</b></label>
                            <input type="text" placeholder="Enter CVV from the back of your card" name="cvv" required />
                        </div>
                    </div>

                    <div class="form-element">
                        <button type="button" class="btn cancel" onclick="home()">
                            Cancel
                        </button>
                        <button type="submit" name="order" class="btn">PLACE ORDER</button>
                    </div>
                </div>
            <?php


                if (
                    isset($_REQUEST["collection_date"]) &&
                    isset($_REQUEST["select_days"]) &&
                    isset($_REQUEST["cost"]) &&
                    isset($_REQUEST["name_on_card"]) &&
                    isset($_REQUEST["expiry_date"]) &&
                    isset($_REQUEST["billing_address"]) &&
                    isset($_REQUEST["card_number"]) &&
                    isset($_REQUEST["cvv"])
                ) {
                    $user_id = $_SESSION['user_id'];
                    $provision_id = $_REQUEST['productId'];
                    $provider_id = $row["provider_id"];
                    $collection_date = date('Y-m-d\TH:i:s', strtotime($_REQUEST['collection_date']));
                    $select_days = $_REQUEST["select_days"];
                    $cost = $_REQUEST["cost"];
                    $name_on_card = $_REQUEST["name_on_card"];
                    $billing_address = $_REQUEST["billing_address"];
                    $expiry_date = date('Y-m-d', strtotime($_REQUEST['expiry_date']));
                    $card_number = $_REQUEST["card_number"];
                    $card_number = md5($card_number);
                    $cvv = $_REQUEST["cvv"];
                } else {
                    $collection_date = date("Y-m-d h:i:sa");
                    $select_days = NULL;
                    $cost = NULL;
                    $name_on_card = NULL;
                    $billing_address = NULL;
                    $expiry_date = date("Y-m-d");
                    $card_number = NULL;
                    $cvv = NULL;
                }

                if (isset($_REQUEST["order"])) {
                    $billing_insert = "INSERT INTO BILLING(user_id, name_on_card, billing_address, card_number, expiry_date, cvv) VALUES('$user_id','$name_on_card', '$billing_address','$card_number','$expiry_date','$cvv')";
                    if (mysqli_query($mysqli, $billing_insert)) {
                        $order_insert = "INSERT INTO ORDERS(provision_id, unit_amount, cost, request_date, collection_date, consumer_id, provider_id) VALUES('$provision_id', '$select_days', '$cost', NOW(),'$collection_date','$user_id', '$provider_id')";
                        if (mysqli_query($mysqli, $order_insert)) {

                            $selectLastOrderID = mysqli_query($mysqli, "SELECT * FROM ORDERS ORDER BY order_id DESC LIMIT 1");
                            $rowLastOrderID = mysqli_fetch_array($selectLastOrderID);
                            $lastOrderID = $rowLastOrderID['order_id'];
                            $collection_date = $rowLastOrderID['collection_date'];

                            $resultProvision = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $provision_id");
                            $rowProvision = mysqli_fetch_array($resultProvision);
                            $collection_address = $rowProvision['provision_address'];


                            $collection_insert = "INSERT INTO COLLECTION(provision_id, order_id, collection_address, collection_datetime, collection_status) VALUES('$provision_id', '$lastOrderID', '$collection_address', '$collection_date','PENDING')";

                            if (mysqli_query($mysqli, $collection_insert)) {
                                $provision_update = "UPDATE PROVISION SET available = 'NO' WHERE provision_id = $provision_id";
                                mysqli_query($mysqli, $provision_update);
                                echo ("<script>window.alert('ORDER PLACED, CURRENTLY UNDER REVIEW BY THE OWNER. \n TO VIEW YOUR ORDERS, CLICK ON THE ACCOUNT NAME.');</script>");
                                echo ("<script>window.location.href = 'MANAGE ACCOUNT.php';</script>");
                            }
                        }
                    }
                }
            }
            ?>
        </form>
    </body>

</section>

</html>
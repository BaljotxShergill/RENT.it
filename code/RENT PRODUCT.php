<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
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
        if (isset($_GET['productId'])) {
            $search = $_GET['productId'];
        } else {
            $search = null;
        }
        ?>
        <form class="rent-product" action="" method="get">
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id LIKE $search ");
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
                            <input type="date" placeholder="Enter date from when to start" name="collection_date" required />
                        </div>

                        <div class="selectList">
                            <label for="num_days"><b>NUMBER OF DAYS</b></label>
                            <select name="select_days" placeholder="Select number of days" onchange="calculateAmount(this.value)">
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
            }

            // Connect to server/database
            include("database.php");

            if (
                isset($_REQUEST["collection_date"]) &&
                isset($_REQUEST["select_days"]) &&
                isset($_REQUEST["cost"]) &&
                isset($_REQUEST["name_on_card"]) &&
                isset($_REQUEST["billing_address"]) &&
                isset($_REQUEST["card_number"]) &&
                isset($_REQUEST["cvv"])
            ) {
                $collection_date = date('Y-m-d', strtotime($_REQUEST['collection_date']));
                $select_days = $_REQUEST["select_days"];
                $cost = $_REQUEST["cost"];
                $name_on_card = $_REQUEST["name_on_card"];
                $billing_address = $_REQUEST["billing_address"];
                $card_number = $_REQUEST["card_number"];
                $cvv = $_REQUEST["cvv"];
            } else {
                $collection_date = date("Y-m-d");
                $select_days = NULL;
                $cost = NULL;
                $name_on_card = NULL;
                $billing_address = NULL;
                $card_number = NULL;
                $cvv = NULL;
            }

            if (isset($_REQUEST['order'])) {
            }

            ?>
        </form>
    </body>

    <ul class="social">
        <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png">
        <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png">
        <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png">
    </ul>
</section>

</html>
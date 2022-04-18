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
        if (isset($_SESSION['user_id'])) {
            $consumer_id = $_SESSION['user_id'];
            $user = $_SESSION['user'];
        } else {
            $consumer_id = null;
        }
        ?>

        <form class="products" action="" method="post">
            <table class="tblproducts">
                <h1 class="searchres">ORDERS: </h1>
                <br>
                <th>ORDER ID</th>
                <th>PRODUCT ID</th>
                <th>PERIOD</th>
                <th>COST</th>
                <th>REQUESTED ON</th>
                <th>COLLECTION DATE</th>
                <th>CONSUMER ID</th>
                <th>PROVIDER ID</th>
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM ORDERS");
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td><?php echo $row['order_id']; ?></td>
                        <td>
                            <button type="submit" name="viewProduct" class="btnID" value=" <?php echo $row['provision_id']; ?>">
                                <?php echo $row['provision_id']; ?>
                            </button>
                        </td>
                        <?php
                        if ($row['unit_amount'] > 1) {
                        ?>
                            <td><?php echo $row['unit_amount'] . " days"; ?></td>
                        <?php
                        } else {
                        ?>
                            <td><?php echo $row['unit_amount'] . " day"; ?></td>
                        <?php
                        }
                        ?>
                        <td><?php echo "£" . $row['cost']; ?></td>
                        <td><?php echo $row['request_date']; ?></td>
                        <td><?php echo $row['collection_date']; ?></td>
                        <td>
                            <button type="submit" name="viewConsumer" class="btnID" value="<?php echo $row['consumer_id'] ?>">
                                <?php echo $row['consumer_id'] ?>
                            </button>
                        </td>
                        <td>
                            <button type="submit" name="viewProvider" class="btnID" value="<?php echo $row['provider_id'] ?>">
                                <?php echo $row['provider_id'] ?>
                            </button>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </table>
            <br>
            <table class="tblOrders">
                <?php
                if (isset($_REQUEST['viewConsumer']) || isset($_REQUEST['viewProvider'])) {
                    if (isset($_REQUEST['viewConsumer'])) {
                        $id = $_REQUEST['viewConsumer'];
                    } else {
                        $id = $_REQUEST['viewProvider'];
                    }
                ?>
                    <h1 class="searchres">MORE INFO FOR ID: <?php echo $id ?></h1>
                    <th>SURNAME</th>
                    <th>FORENAME</th>
                    <th>DATE OF BIRTH</th>
                    <th>CONTACT NUMBER</th>
                    <th>HOME ADDRESS</th>
                    <th>EMAIL</th>
                    <?php
                    if ($id != NULL) {
                        $result = mysqli_query($mysqli, "SELECT * FROM USERS WHERE user_id = $id");
                        while ($rowUser = mysqli_fetch_array($result)) {
                    ?>
                            <tr>
                                <td><?php echo $rowUser['surname']; ?></td>
                                <td><?php echo $rowUser['forename']; ?></td>
                                <td><?php echo $rowUser['dob']; ?></td>
                                <td><?php echo $rowUser['contact_number']; ?></td>
                                <td><?php echo $rowUser['home_address']; ?></td>
                                <td><?php echo $rowUser['user_email']; ?></td>
                            </tr>
                        <?php
                        }
                        ?>
                    <?php
                    }
                } elseif (isset($_REQUEST['viewProduct'])) {
                    $id = $_REQUEST['viewProduct'];

                    ?>
                    <h1 class="searchres">MORE INFO FOR PRODUCT ID: <?php echo $id ?></h1>
                    <th>NAME</th>
                    <th>DESCRIPTION</th>
                    <th>TYPE</th>
                    <th>COST</th>
                    <th>ADDRESS</th>
                    <?php
                    if ($id != NULL) {
                        $selectProduct = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $id");
                        while ($rowProvision = mysqli_fetch_array($selectProduct)) {
                    ?>
                            <tr>
                                <td><?php echo $rowProvision['provision_title']; ?></td>
                                <td><?php echo $rowProvision['provision_description']; ?></td>
                                <td><?php echo $rowProvision['provision_type']; ?></td>
                                <td><?php echo "£" . $rowProvision['rate'], "  ", $rowProvision['rate_unit_type']; ?></td>
                                <td><?php echo $rowProvision['provision_address']; ?></td>
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
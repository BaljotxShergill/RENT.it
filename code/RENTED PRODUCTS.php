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
            $user_id = $_SESSION['user_id'];
        } else {
            $user_id = null;
        }
        ?>
        <form class="products" action="" method="post">
            <table class="tblproducts">
                <h1 class="searchres">RENTED PRODUCTS</h1>
                <br>
                <th></th>
                <th>NAME</th>
                <th>REQUEST DATE</th>
                <th>COLLECTION ADDRESS</th>
                <th>COLLECTION DATE/TIME</th>
                <th>PERIOD</th>
                <th>AMOUNT</th>
                <th>RETURN DATE</th>
                <?php
                $selectOrders = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE provider_id = $user_id");
                while ($rowOrder = mysqli_fetch_array($selectOrders)) {
                    $rowOrderID = $rowOrder['order_id'];

                    $selectCollection = mysqli_query($mysqli, "SELECT * FROM COLLECTION WHERE order_id = $rowOrderID AND collection_status LIKE '%APPROVED%'");

                    if ($rowCollection = mysqli_fetch_array($selectCollection)) {
                        $count = mysqli_num_rows($selectCollection);

                        $rowProvisionID = $rowOrder['provision_id'];
                        $resultProvision = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $rowProvisionID");
                        $rowProvision = mysqli_fetch_array($resultProvision);

                ?>
                        <tr>
                            <td>
                                <?php if ($rowProvision['image_url_1']) {
                                ?>
                                    <?php $imageURL1 = 'image/' . $rowProvision["image_url_1"]; ?>
                                    <img id='listimg' src="<?php echo $imageURL1; ?>" alt="" />
                                <?php
                                } ?>
                            </td>
                            <td><?php echo $rowProvision['provision_title']; ?></td>
                            <td><?php echo $rowOrder['request_date']; ?></td>
                            <td><?php echo $rowCollection['collection_address']; ?></td>
                            <td><?php echo $rowCollection['collection_datetime']; ?></td>

                            <?php
                            if ($rowOrder['unit_amount'] > 1) {
                            ?>
                                <td><?php echo $rowOrder['unit_amount'] . " days"; ?></td>
                            <?php
                            } else {
                            ?>
                                <td><?php echo $rowOrder['unit_amount'] . " day"; ?></td>
                            <?php
                            }
                            ?>

                            <td><?php echo "£" . $rowOrder['cost']; ?></td>

                            <td>
                                <p id="returnDate">return date unvailable</p>
                                <script>
                                    collection_date = new Date("<?php echo $rowCollection['collection_datetime'] ?>");
                                    days = "<?php echo $rowOrder['unit_amount'] ?>";
                                    calculateDate(collection_date, days);
                                </script>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                <?php
                }



                ?>
            </table>
        </form>
    </body>
</section>

</html>
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
        if (isset($_SESSION['user_id'])) {
            $consumer_id = $_SESSION['user_id'];
            $user = $_SESSION['user'];
        } else {
            $consumer_id = null;
        }
        ?>

        <form class="products" action="index.php" method="post">
            <table class="tblproducts">
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE provision_id LIKE $consumer_id");
                if (mysqli_fetch_array($result) == 0) {
                ?>
                    <h1 class="searchres">No Order placed for: <?php echo $user; ?></h1>
                <?php
                } else {
                ?>
                    <th>PERIOD</th>
                    <th>COST</th>
                    <th>REQUEST DATE</th>
                    <th>COLLECTION DATE</th>
                    <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE provision_id LIKE $consumer_id");
                    // WHERE provision_id LIKE $consumer_id
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <tr>
                            <td><?php echo $row['unit_amount']; ?></td>
                            <td><?php echo $row['cost']; ?></td>
                            <td><?php echo $row['request_date']; ?></td>
                            <td><?php echo $row['collection_date']; ?></td>
                        </tr>
                <?php

                        // stuff here




                    }
                }
                ?>
            </table>
        </form>


    </body>

    <ul class="social">
        <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png">
        <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png">
        <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png">
    </ul>
</section>


</html>
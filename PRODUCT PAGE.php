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
        <form class="products" action="" method="get">
            <?php
            $result = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id LIKE $search ");
            while ($row = mysqli_fetch_array($result)) {
            ?>
                <div class="row">
                    <div class="column">

                        <div class="product-box">
                            <div class="all-images">
                                <div class="small-images">
                                    <?php if ($row['image_url_2']) {
                                    ?>
                                        <?php echo "<img  onclick='clickimg(this)' src=" . $row['image_url_2'] . " >"; ?>
                                    <?php
                                    } ?>
                                    <?php if ($row['image_url_3']) {
                                    ?>
                                        <?php echo "<img onclick='clickimg(this)' src=" . $row['image_url_3'] . " >"; ?>
                                    <?php
                                    } ?>
                                    <?php if ($row['image_url_4']) {
                                    ?>
                                        <?php echo "<img  onclick='clickimg(this)' src=" . $row['image_url_4'] . " >"; ?>
                                    <?php
                                    } ?>
                                    <?php if ($row['image_url_5']) {
                                    ?>
                                        <?php echo "<img  onclick='clickimg(this)' src=" . $row['image_url_5'] . " >"; ?>
                                    <?php
                                    } ?>
                                </div>
                                <div class="main-images">
                                    <?php if ($row['image_url_1']) {
                                    ?>
                                        <?php echo "<img id='imagebox' src=" . $row['image_url_1'] . " >"; ?>
                                    <?php
                                    } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="column">
                        <h1><?php echo $row['provision_title']; ?></h1>
                        <h2><?php echo $row['provision_description']; ?></h2>

                        <div class="price-box">
                            <p class="price">&#163; <?php echo $row['rate'], "  ", $row['rate_unit_type']; ?></p>
                            <strike>&#163; <?php echo $row['rate'] + rand(0, 10), "  ", $row['rate_unit_type']; ?></strike>
                        </div>

                        <button class="btn rent">
                            <span class="fa fa-shopping-cart">
                            </span>
                            <h3>RENT NOW</h3>
                        </button>

                    </div>
                </div>
                <h1 style="  
                color: black;
                text-transform: uppercase;
                font-size: 3em;
                display: flex;
                margin-left: auto;
                margin-right: auto;
                align-content: flex-start;
                justify-content: center;
                margin-top: inherit;">
                    EXPLORE MORE PRODUCTS
                </h1>
                <div class="row">

                    <?php
                    $max = mysqli_query($mysqli, "SELECT * FROM PROVISION");
                    $max = mysqli_num_rows($max);
                    $rand = rand(0, $max);
                    $result = mysqli_query($mysqli, "SELECT * FROM PROVISION LIMIT 4 OFFSET $rand");
                    while ($row = mysqli_fetch_array($result)) {
                    ?>
                        <div class="card">
                            <?php if ($row['image_url_1']) {
                            ?>
                                <?php echo "<img id='pimg' src=" . $row['image_url_1'] . " >"; ?>
                            <?php
                            } ?>
                            <h1><?php echo $row['provision_title']; ?></h1>
                            <button class="btn view" type="submit" value=<?php echo $row['provision_id']; ?>>
                                <h3>VIEW NOW</h3>
                            </button>
                        </div>

                    <?php
                    }
                    ?>


                </div>
            <?php
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
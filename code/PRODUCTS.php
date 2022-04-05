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
        ?>
        <form class="products" action="PRODUCT PAGE.php" method="post">
            <table class="tblproducts">
                <th></th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>COST</th>
                <th></th>
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE available != 'NO'");
                while ($row = mysqli_fetch_array($result)) {
                ?>
                    <tr>
                        <td>
                            <?php if ($row['image_url_1']) {
                            ?>
                                <?php $imageURL1 = 'image/' . $row["image_url_1"]; ?>
                                <img id='listimg' src="<?php echo $imageURL1; ?>" alt="" />
                            <?php
                            } ?>
                        </td>
                        <td><?php echo $row['provision_title']; ?></td>
                        <td><?php echo $row['provision_description']; ?></td>
                        <td style="width: 15%;"><?php echo "£" . $row['rate'], "  ", $row['rate_unit_type']; ?></td>
                        <td>
                            <button id="btnview" style="width: auto;" type="submit" name="productId" value=<?php echo $row['provision_id']; ?>><span>VIEW </span></button>
                        </td>
                    </tr>

                <?php
                }
                ?>
            </table>
        </form>
    </body>
</section>

</html>
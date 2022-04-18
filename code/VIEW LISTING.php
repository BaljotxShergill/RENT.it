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
        <form class="products" action="" method="post">
            <table class="tblproducts">
                <h1 class="searchres">YOUR LISTING</h1>
                <br>
                <th></th>
                <th>NAME</th>
                <th>DESCRIPTION</th>
                <th>COST</th>
                <th></th>
                <?php
                $provider_id = $_SESSION['user_id'];
                $result = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provider_id = $provider_id");
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
                            <button type="submit" name="removeProduct" class="btnID" style="color: red;" value="<?php echo $row['provision_id']; ?>">
                                &#x2715;
                            </button>
                        </td>
                    </tr>

                <?php
                }
                if (isset($_REQUEST['removeProduct'])) {
                    $productID = $_REQUEST['removeProduct'];
                } else {
                    $productID = NULL;
                }
                if ($productID != NULL && isset($_REQUEST['removeProduct'])) {
                    $deleteProduct = "DELETE FROM PROVISION WHERE provision_id = $productID";
                    mysqli_query($mysqli, $deleteProduct);
                    echo ("<script>window.alert('PRODUCT REMOVED.');</script>");
                    echo ("<script>window.location.href = 'VIEW LISTING.php';</script>");
                }



                ?>
            </table>
        </form>
    </body>
</section>

</html>
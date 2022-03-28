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
        if (!isset($_SESSION['user'])) {
            header("Location:login form.php");
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

        <form class="form" action="LEND.php" style="border: 1px solid #ccc" method="post" enctype="multipart/form-data">
            <div class="container-row">
                <div class="container-col">
                    <div class="form-element">
                        <label for="provision_title"><b>PRODUCT NAME</b></label>
                        <input type="text" placeholder="Enter name of the product" name="provision_title" required />
                    </div>

                    <div class="form-element">
                        <label for="provision_description"><b>PRODUCT DESCRIPTION</b></label>
                        <input type="text" placeholder="Enter product description" name="provision_description" />
                    </div>

                    <div class="form-element" style="height:10em;">
                        <label for="provision_address"><b>PRODUCT ADDRESS</b></label>
                        <input type="text" placeholder="Enter where the product is located" name="provision_address" required />
                    </div>
                </div>

                <div class="container-col">
                    <div class="form-element">
                        <label for="rate"><b>RATE (£)</b></label>
                        <input type="text" placeholder="Enter product cost" name="rate" required />
                    </div>

                    <div class="selectList">
                        <label for="rate_unit_type">RATE PERIOD </label>
                        <select placeholder="Select rate period" name="rate_unit_type" required>
                            <option value="PER DAY">PER DAY</option>
                            <option value="PER HOUR">PER HOUR</option>
                            <option value="PER SHEET">PER SHEET</option>
                        </select>
                    </div>

                    <div class="selectList">
                        <label for="provision_type">PRODUCT TYPE</label>
                        <select placeholder="Select product type" name="provision_type" required>
                            <option value="RENT">RENT</option>
                            <option value="SERVICE">SERVICE</option>
                        </select>
                    </div>

                    <div class="selectList">
                        <label for="available">AVAILABLE </label>
                        <select placeholder="Select avalaibility" name="available" required>
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                </div>

                <div class="container-row">
                    <div class="uploadImg">
                        <label for="upload">SELECT IMAGE FILE TO UPLOAD: </label>
                        <input type="file" name='img1' required>
                        <input type="file" name='img2'>
                        <input type="file" name='img3'>
                        <input type="file" name='img4'>
                        <input type="file" name='img5'>
                    </div>

                    <div class="form-element">
                        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                        <button type="button" class="btn cancel" onclick="home()">
                            Cancel
                        </button>
                        <button type="submit" class="btn" name="upload">UPLOAD</button>
                    </div>
                </div>
            </div>

            <?php
            include("database.php");
            $provision_title = $_REQUEST['provision_title'] ?? "";
            $provision_description = $_REQUEST['provision_description'] ?? "";
            $provision_type = $_REQUEST['provision_type'] ?? "";
            $rate = $_REQUEST['rate'] ?? "";
            $rate_unit_type = $_REQUEST['rate_unit_type'] ?? "";
            $provider_id = $_SESSION['user_id'] ?? "";
            $available = $_REQUEST['available'] ?? "";
            $provision_address = $_REQUEST['provision_address'] ?? "";
            $targetDir = "image/";

            // // img1
            if (isset($_FILES['img1']['name']) && isset($_FILES['img1']['tmp_name'])) {
                $fileName1 = basename($_FILES['img1']['name']);
                $tempImg1 = $_FILES['img1']['tmp_name'];
                $targetFilePath1 = $targetDir . $fileName1;
            }

            // // img2
            if (isset($_FILES['img2']['name']) && isset($_FILES['img2']['tmp_name'])) {
                $fileName2 = basename($_FILES['img2']['name']);
                $tempImg2 = $_FILES['img2']['tmp_name'];
                $targetFilePath2 = $targetDir . $fileName2;
            }

            // // img3
            if (isset($_FILES['img3']['name']) && isset($_FILES['img3']['tmp_name'])) {
                $fileName3 = basename($_FILES['img3']['name']);
                $tempImg3 = $_FILES['img3']['tmp_name'];
                $targetFilePath3 = $targetDir . $fileName3;
            }

            // // img4
            if (isset($_FILES['img4']['name']) && isset($_FILES['img4']['tmp_name'])) {
                $fileName4 = basename($_FILES['img4']['name']);
                $tempImg4 = $_FILES['img4']['tmp_name'];
                $targetFilePath4 = $targetDir . $fileName4;
            }

            // // img5
            if (isset($_FILES['img5']['name']) && isset($_FILES['img5']['tmp_name'])) {
                $fileName5 = basename($_FILES['img5']['name']);
                $tempImg5 = $_FILES['img5']['tmp_name'];
                $targetFilePath5 = $targetDir . $fileName5;
            }

            // If upload button is clicked ...
            if (isset($_REQUEST['upload']) && $_REQUEST['randcheck'] == $_SESSION['rand']) {

                // Get all the submitted data from the form
                $sql = "INSERT INTO PROVISION(provision_title, provision_description, provision_type, rate, rate_unit_type, provider_id, available, provision_address, image_url_1,image_url_2,image_url_3,image_url_4,image_url_5) VALUES('$provision_title', '$provision_description', '$provision_type', '$rate', '$rate_unit_type', '$provider_id', '$available', '$provision_address', '" . $fileName1 . "', '" . $fileName2 . "', '" . $fileName3 . "', '" . $fileName4 . "', '" . $fileName5 . "')";

                // Excute query and move images into the folder in the server
                if (
                    mysqli_query($mysqli, $sql) &&
                    move_uploaded_file($tempImg1, $targetFilePath1) &&
                    move_uploaded_file($tempImg2, $targetFilePath2) &&
                    move_uploaded_file($tempImg3, $targetFilePath3) &&
                    move_uploaded_file($tempImg4, $targetFilePath4) &&
                    move_uploaded_file($tempImg5, $targetFilePath5)
                ) {
                    echo ("<script>window.alert('PRODUCT HAS BEEN LISTED.');</script>");
                } else {
                    $delete = "DELETE from PROVISION ORDER BY provision_id DESC limit 1";
                    mysqli_query($mysqli, $delete);
                    echo ("<script>window.alert('ERROR! IMAGES COULD NOT BE UPLOADED. PRODUCT NOT LISTED.');</script>");
                }
            }
            ?>
            </div>
        </form>

    </body>

    <ul class="social">
        <li><a href="#"><img src="https://i.ibb.co/x7P24fL/facebook.png">
        <li><a href="#"><img src="https://i.ibb.co/Wnxq2Nq/twitter.png">
        <li><a href="#"><img src="https://i.ibb.co/ySwtH4B/instagram.png">
    </ul>
</section>


</html>
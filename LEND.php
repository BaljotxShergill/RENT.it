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

        <form class="form" action="LEND.php" style="border: 1px solid #ccc" method="post">
            <div class="container-row">
                <div class="container-col">
                    <div class="form-element">
                        <label for="provision_title"><b>PRODUCT NAME</b></label>
                        <input type="text" placeholder="Enter name of the product" name="provision_title" required />
                    </div>

                    <div class="form-element">
                        <label for="provision_description"><b>PRODUCT DESCRIPTION</b></label>
                        <input type="text" placeholder="Enter product description" name="provision_description" required />
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
                        <select placeholder="Select rate period" name="rate_unit_type">
                            <option value="PER DAY">PER DAY</option>
                            <option value="PER HOUR">PER HOUR</option>
                            <option value="PER SHEET">PER SHEET</option>
                        </select>
                    </div>

                    <div class="selectList">
                        <label for="provision_type">PRODUCT TYPE</label>
                        <select placeholder="Select product type" name="provision_type">
                            <option value="RENT">RENT</option>
                            <option value="SERVICE">SERVICE</option>
                        </select>
                    </div>

                    <div class="selectList">
                        <label for="available">AVAILABLE </label>
                        <select placeholder="Select avalaibility" name="available">
                            <option value="YES">YES</option>
                            <option value="NO">NO</option>
                        </select>
                    </div>
                </div>

                <div class="container-row">
                    <div class="uploadImg">
                        <label for=" available">SELECT IMAGE FILE TO UPLOAD: </label>
                        <input type="file" name="file">
                        <input type="file" name="file">
                        <input type="file" name="file">
                        <input type="file" name="file">
                        <input type="file" name="file">
                        <input type="submit" class="btn" name="submit" value="Upload">
                    </div>

                    <div class="form-element">
                        <button type="button" class="btn cancel" onclick="home()">
                            Cancel
                        </button>
                        <button type="submit" class="btn">UPLOAD</button>
                    </div>
                </div>
            </div>

            <?php
            include("database.php");


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
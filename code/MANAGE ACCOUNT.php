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
                <?php
                $result = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE consumer_id = $consumer_id");
                if (mysqli_fetch_array($result) == 0) {
                ?>
                    <h1 class="searchres">YOU HAVE NOT PLACED AN ORDER YET</h1>
                <?php
                } else {
                ?>
                    <h1 class="searchres">YOUR ORDERS:</h1>
                    <br>
                    <th>NAME</th>
                    <th>COST</th>
                    <th>REQUEST DATE</th>
                    <th>COLLECTION DATE</th>
                    <th>PERIOD</th>
                    <th>COLLECTION ADDRESS</th>
                    <?php
                    $result = mysqli_query($mysqli, "SELECT * FROM ORDERS WHERE consumer_id = $consumer_id");
                    while ($row = mysqli_fetch_array($result)) {
                        $rowId = $row['provision_id'];
                        $resultProvision = mysqli_query($mysqli, "SELECT * FROM PROVISION WHERE provision_id = $rowId");
                        $rowProvision = mysqli_fetch_array($resultProvision);
                    ?>
                        <tr>
                            <td><?php echo $rowProvision['provision_title']; ?></td>
                            <td><?php echo "£" . $row['cost']; ?></td>
                            <td><?php echo $row['request_date']; ?></td>
                            <td><?php echo $row['collection_date']; ?></td>
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
                            <td><?php echo $rowProvision['provision_address']; ?></td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </form>


    </body>
</section>


</html>
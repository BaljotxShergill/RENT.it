<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="design.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <div class="searchbar">
        <?php include("searchbar.php") ?>
    </div>

    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="LEND.php">LEND</a></li>
        <li><a href="RENT.php">RENT</a></li>
        <li><a href="HELP.php">HELP</a></li>
        <?php

        if (isset($_SESSION["user"])) {
            $session_User = $_SESSION["user"];
        } else {
            $session_User = null;
        }

        $admin = "admin";
        if ($session_User == $admin) {
        ?>
            <li>
                <strong>
                    ADMIN
                </strong>
            </li>
        <?php
            echo "<button class='login' onclick='logout()'>LOGOUT</button>";
        } elseif ($session_User) {

        ?>
            <li style="color: white;">
                Welcome,
                <strong>
                    <?php echo $session_User . '  '; ?>
                </strong>
                <?php echo "<button class='login' onclick='logout()'>LOGOUT</button>"; ?>
            </li>
        <?php
        } else {
            echo "<button class='login' onclick='openForm()'>LOGIN</button>";
        }
        ?>
        </li>
    </ul>

    </div>

</html>
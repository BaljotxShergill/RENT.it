<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="design.css">
</head>

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <div class="searchbar">
        <input type="text" placeholder="start typing to search...">
        <i class="fa fa-search"></i>
    </div>
    <ul>
        <li><a href="index.php">HOME</a></li>
        <li><a href="LEND.php">LEND</a></li>
        <li><a href="RENT.php">RENT</a></li>
        <li><a href="HELP.php">HELP</a></li>
        <li style='float:right' class="username">
            <?php

            $admin = "admin";
            if (isset($_SESSION)) {
                if ($_SESSION["user"] == $admin) {
                    echo $_SESSION["user"];
                    echo "<li style='background:red'><a href='admin options.php'>Edit</a></li>";
                    echo "</li><li style='float:right'><a class='active' href='logout.php'>Logout</a></li>";
                } elseif ($_SESSION['user']) {
                    echo $_SESSION["user"];
                    echo "<button class='login' onclick='logout()'>LOGOUT</button>";
                } else {
                    echo "<button class='login' onclick='openForm()'>LOGIN</button>";
                }
            }
            ?>
        </li>
    </ul>

    </div>

</html>l
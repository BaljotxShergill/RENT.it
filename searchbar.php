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

<body>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
    <form class="frmSearch" action="PRODUCTS LOOKUP.php" method=get>
        <input type="text" name="search" placeholder="search for more...">
        <button type="submit" class="btnSearch"> <i class="fa fa-search"></i></button>
        <button type="reset" class="btnReset">CLEAR</i></button>
    </form>
</body>

</html>
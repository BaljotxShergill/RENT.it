<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product page</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<header>
    <?php
    if (!isset($_SESSION)) {
        session_start();
    }
    ?>
</header>

<body>

    <?php
    include("database.php");
    $max = mysqli_query($mysqli, "SELECT * FROM PROVISION");
    $max = mysqli_num_rows($max);
    $rand = rand(0, $max);
    $result = mysqli_query($mysqli, "SELECT * FROM PROVISION LIMIT 4 OFFSET $rand");
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <div class="card">
            <?php if ($row['image_url_1']) {
            ?>
                <?php $imageURL1 = 'image/' . $row["image_url_1"]; ?>
                <img id="boximg" src="<?php echo $imageURL1; ?>" alt="" />

            <?php
            } ?>
            <h1><?php echo $row['provision_title']; ?></h1>
            <button class="btn view" type="submit" value=<?php echo $row['provision_id']; ?>>
                <h3>VIEW</h3>
            </button>
        </div>

    <?php
    }
    ?>

</body>

</html>
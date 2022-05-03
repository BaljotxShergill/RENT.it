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
        <div class="container-row" style="margin-top: 10%;">
            <div class="text">
                <h4>RENT.it is a website host which enables you to register physical products and services for monetary compensation. </h4>
                <h4> The rules of our website are the following: </h4>
                <ol TYPE=”A”>
                    <li>Age -Users must be over 18 years of age. A valid form of photo identification (ID) must be provided before accessing the perks of this service (Passport, full or provisional driver’s licence).</li>
                    <li>Country -This platform is only available in the regions of the United Kingdom (England, Scotland, Wales and Norther Ireland) therefore the User must be a UK resident must be able to provide residential proof if prompted.</li>
                    <li>Address-Users must provide a valid UK address and postcode when registering. In the event that this primary address needs to be changed, the user must update these details if they wish to continue using our RENT.it services.</li>
                    <li>Real data-You must provide accurate and complete information when using this platform. Real data about the products or services that you are registering to not create false or deceiving advertisement and real data about yourself so that we can provide accurate location-sensitive recommendations, appropriate monetary transactions and ID verification. </li>
                    <li>Registering items-Before using our platform, we recommend you being cautious over the products and/or services that you wish to register to your account and to our servers.We openly discourage the public registration of items such as:
                        <ul>
                            <li>Liveorganisms (including people, animals or plants in their living or deceased form).</li>
                            <li>Food(perishable or unperishable).</li>
                            <li>Valuableitems –to reduce the risk of them being mistreated or stolen by others. </li>
                            <li>Items containing illegalsubstances such as recreational drugs, alcohol, tobacco, medical and non-medical prescriptions.</li>
                            <li>Unsanitaryand ‘one-time use only’ items, these items must be disposed after used, they cannot be registered to be rented by others. </li>
                        </ul>
                    </li>
                    <li>Failure to comply to the regulations above will result in terminating your account and holding you accountable for the actions made.</li>
                    <li>Rented items: under no circumstances you are allowed to sell or rent the physically rented product or attempt to return the money to the provider instead of the item.</li>
                    <li>Refunds–you may request a refund when items you registered are not returned/delivered in time, damaged, or lost; however, the amount will not be fixed and will be managed by our RENT.it moderators.</li>
                </ol>
                <h4> Before using the RENT.it platform, we recommend that you read the Terms and Conditions to ensure that you are happy with them. </h4>

            </div>
        </div>
    </body>
</section>


</html>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <script src="script.js"></script>
  <title>RENT.it</title>
</head>
<section class="showcase">

  <header>
    <h1>RENT.it</h1>

    <div class="navbar">
      <?php
      include("navbar.php")
      ?>
    </div>
  </header>

  <body>
    <?php
    if (!isset($_SESSION)) {
      session_start();
    }
    ?>
    <form class="form" action="index.php" style="border: 1px solid #ccc" method="POST">
      <div class="container-row">
        <h1 style="display: flex;  color: black">
          CREATE AN ACCOUNT
        </h1>
        <p>Please fill in this form to create an account.</p>
        <div class="accountList">
          <label for="account_type">ACCOUNT TYPE</label>
          <select placeholder="Select account type..." name="account_type">
            <option value="CONSUMER">STANTARD ACCOUNT</option>
            <option value="PROVIDER">RENTER ACCOUNT</option>
          </select>
        </div>
      </div>
      <div class="container-row">
        <div class="container-col">
          <div class="form-element">
            <label for="surname"><b>SURNAME</b></label>
            <input type="text" placeholder="Enter Surname" name="surname" required />
          </div>

          <div class="form-element">
            <label for="forename"><b>FORENAME</b></label>
            <input type="text" placeholder="Enter Forename" name="forename" required />
          </div>

          <div class="form-element">
            <label for="dob"><b>DATE OF BIRTH</b></label>
            <input type="date" placeholder="Enter Date of Birth" name="dob" required />
          </div>

          <div class="form-element">
            <label for="contact_number"><b>CONTACT NUMBER</b></label>
            <input type="text" placeholder="Enter Contact Number " name="contact_number" required />
          </div>
        </div>
        <div class="container-col">
          <div class="form-element">
            <label for="home_address"><b>HOME ADDRESS</ADDress></b></label>
            <input type="text" placeholder="Enter Home Address" name="home_address" required />
          </div>

          <div class="form-element">
            <label for="username"><b>USERNAME</b></label>
            <input type="text" placeholder="Enter Username" name="username" required />
          </div>

          <div class="form-element">
            <label for="user_email"><b>EMAIL</b></label>
            <input type="text" placeholder="Enter Email" name="user_email" required />
          </div>

          <div class="form-element">
            <label for="user_password"><b>PASSWORD</b></label>
            <input type="password" placeholder="Enter Password" name="user_password" required />
          </div>

          <div class="form-element">
            <label for="user_password1"><b>COMFIRM PASSWORD</b></label>
            <input type="password" placeholder="Repeat Password" name="user_password1" onkeyup='check();' required />
          </div>
        </div>

        <div class="form-element">
          <p style="display: flex; margin: auto; margin-bottom: 10px;">
            By creating an account you agree to our
            <a href="HELP.html" style="color: dodgerblue">Terms & Privacy</a>.
          </p>
        </div>

        <div class="form-element">
          <button type="button" class="btn cancel" onclick="home()">
            Cancel
          </button>
          <button type="submit" class="btn">Sign Up</button>
        </div>
      </div>

      <?php
      include("database.php");

      if (
        isset($_REQUEST["username"])
        && isset($_REQUEST["forename"])
        && isset($_REQUEST["dob"])
        && isset($_REQUEST["contact_number"])
        && isset($_REQUEST["home_address"])
        && isset($_REQUEST["username"])
        && isset($_REQUEST["user_email"])
        && isset($_REQUEST["user_password"])
        && isset($_REQUEST["account_type"])
      ) {
        $surname = $_REQUEST['surname'];
        $forename = $_REQUEST['forename'];
        $dob = $_REQUEST['dob'];
        $contact_number = $_REQUEST['contact_number'];
        $home_address = $_REQUEST['home_address'];
        $username = $_REQUEST['username'];
        $user_email = $_REQUEST['user_email'];
        $user_password = $_REQUEST['user_password'];
        $account_type = $_REQUEST['account_type'];
      } else {
        $surname = null;
        $forename = null;
        $dob = null;
        $contact_number = null;
        $home_address = null;
        $username = null;
        $user_email = null;
        $user_password = null;
        $account_type = null;
      }

      $result = mysqli_query($mysqli, "SELECT * FROM USERS WHERE username='$username'");

      if (mysqli_fetch_array($result)) {
        echo "USERNAME ALREADY EXISTS< PLEASE TRY AGAIN";
      } elseif ($username) {
        mysqli_query($mysqli, "INSERT INTO USERS(surname,forename, dob, contact_number, home_address, username, user_password, user_email, creation_date, account_type) 
        VALUES('$surname','$forename','$dob','$contact_number','$home_address','$username','$user_password','$user_email', NOW() , '$account_type')");
        print("<script>window.alert('ACCOUNT CREATED');</script>");
      }

      ?>
      </div>
    </form>
  </body>
</section>

</html>
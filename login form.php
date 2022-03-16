<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" />
  <script src="script.js"></script>
  <title>RENT.it</title>

</head>

<body>
  <?php
  if (!isset($_SESSION)) {
    session_start();
  }
  ?>
  <form action="index.php" class="form-container" method="post">
    <img style="width: 20%; display: flex; margin: auto;" src="login icon.png">

    <label for="username"><b>USERNAME</b></label>
    <input name="username" type="text" placeholder="Enter Username" required>

    <label for="password"><b>PASSWORD</b></label>
    <input name="user_password" type="password" placeholder="Enter Password" required>

    <button type="submit" class="btn">LOGIN</button>
    <button type="button" class="btn cancel" onclick="closeForm()">CLOSE</button>
    <h4 style="text-align:center">- OR -</h4>
    <button type="button" class="btn create" onclick="signup()">SIGN UP</button>
  </form>

  <?php
  if (isset($_REQUEST["username"]) && isset($_REQUEST["user_password"])) {
    $username_User = $_REQUEST["username"];
    $password_User = $_REQUEST["user_password"];
  } else {
    $username_User = null;
    $password_User = null;
  }
  // Connect to server/database
  include("database.php");

  // Run SQL query
  $res = mysqli_query($mysqli, "SELECT * FROM USERS WHERE username='$username_User' AND user_password='$password_User'");
  $row = mysqli_fetch_array($res);

  if ($row) {
    $_SESSION["user"] = $row['forename'];
  } elseif ($username_User && $password_User) {
    echo "Error!...Try again";
  }
  ?>

</body>

</html>
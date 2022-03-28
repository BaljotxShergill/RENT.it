<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" type="text/css" href="style.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.10.2/css/all.css" />
  <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
  <script src="script.js"></script>
  <title>RENT.it</title>
</head>

<body>
  <form action="" class="form-container" method="post">
    <img style="width: 20%; display: flex; margin: auto;" src="login icon.png">

    <label for="email"><b>EMAIL</b></label>
    <input name="email" type="text" placeholder="Enter EMAIL" required>


    <button name="submit" type="submit" class="btn">SEND REQUEST</button>
    <button type="button" class="btn cancel" onclick="home()">CANCEL</button>
  </form>

  <?php
  // Connect to server/database
  include("database.php");

  if (!isset($_SESSION)) {
    session_start();
  }
  if (isset($_REQUEST["username"]) && isset($_REQUEST["user_password"])) {
    $username_User = mysqli_real_escape_string($mysqli, $_REQUEST["username"]);
    $password_User = mysqli_real_escape_string($mysqli, $_REQUEST["user_password"]);
  } else {
    $username_User = null;
    $password_User = null;
  }

  if (isset($_REQUEST['submit'])) {
    // Run SQL query
    echo ("<script>window.alert($username_User, $password_User);</script>");
    $res = mysqli_query($mysqli, "SELECT * FROM USERS WHERE username='$username_User' AND user_password='$password_User'");
    $row = mysqli_fetch_array($res);
    if ($res->num_rows == 1) {
      $_SESSION['user'] = $username_User;
      $_SESSION['user_id'] = $row['user_id'];
      header('Location: index.php');
    } elseif ($username_User && $password_User) {
      echo ("<script>window.alert('USERNAME OR PASSWORD INCORRECT, PLEASE TRY AGAIN.');</script>");
    }
  }
  ?>

</body>

</html>
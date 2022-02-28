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
  <form action="" class="form-container">
    <img style="width: 20%; display: flex; margin: auto;" src="login icon.png">

    <label for="email"><b>EMAIL</b></label>
    <input name="username" type="text" placeholder="Enter Email" required>

    <label for="psw"><b>PASSWORD</b></label>
    <input name="password" type="password" placeholder="Enter Password" required>

    <button type="submit" class="btn">LOGIN</button>
    <button type="button" class="btn cancel" onclick="closeForm()">CLOSE</button>
    <h4 style="text-align:center">- OR -</h4>
    <button type="button" class="btn create" onclick="signup()">SIGN UP</button>

  </form>

  <?php
  // Connect to server/database
  $mysqli = mysqli_connect("localhost", "2038383", "3411", "db2038383");

  $username_User = $_REQUEST['username'];
  $password_User = $_REQUEST['password'];
  if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  // Run SQL query
  $res = mysqli_query($mysqli, "SELECT * FROM USERS WHERE username='$username_User' AND user_password='$password_User'");
  // Are there any errors in my SQL statement?
  if (!$res) {
    print("MySQL error: " . mysqli_error($mysqli));
    exit;
  }

  $row = mysqli_fetch_array($res);

  if ($row) {
    echo "Welcome...You are logged in";


    $_SESSION["user"] = $row['user_email'];
  } elseif ($username_User && $password_User) {
    echo "Error!...Try again";

    trigger_error("failed login attempt");
  }

  // How many rows were returned?
  echo ("<p>" . mysqli_num_rows($res) . " record(s) were returned...</p>");

  // Loop through resultset and display each field's value
  while ($row = mysqli_fetch_assoc($res)) {
    echo $row['username'] . " - " . $row['user_password'] . "<br>";
  }
  ?>

</body>

</html>
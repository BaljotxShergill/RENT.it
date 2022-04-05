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
    <form action="" class="form-container" method="post">
      <div class="form-element">
        <h4 style="text-align:center ; width: 100%;">RESET PASSWORD</h4>
      </div>

      <label for="email"><b>EMAIL</b></label>
      <input name="email" type="text" placeholder="Enter your email..." required>


      <button name="submit" type="submit" class="btn">SEND REQUEST</button>
      <button type="button" class="btn cancel" onclick="home()">CANCEL</button>
    </form>

    <?php
    // Connect to server/database
    include("database.php");
    if (isset($_POST['email'])) {
      $email = mysqli_real_escape_string($mysqli, $_POST['email']);
    } else {
      $email = null;
    }
    if (isset($_REQUEST['submit'])) {
      $sql = "SELECT * FROM USERS WHERE user_email = '$email'";
      $res = mysqli_query($mysqli, $sql);
      $count = mysqli_num_rows($res);
      if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $user_password = $row['user_password'];
        $to = $row['user_email'];
        $subject = "Your Recovered Password";

        $message = "Please use this password to login " . $user_password;
        $headers = "From : admin1@gmail.com";
        if (mail($to, $subject, $message, $headers)) {
          echo '<script> alert("Your Password has been sent to your email. Please check your inbox."); </script>';
        } else {
          echo '<script> alert("Failed to recover your password, try again"); </script>';
        }
      } else {
        echo '<script> alert("This email does not exists in our database."); </script>';
      }
    }
    ?>

  </body>
</section>

</html>
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
  <style type="text/css">
    <?php
    $css = file_get_contents('CSS/style2.css');
    echo $css;
    ?>
  </style>
</head>

<header>
  <h1 style="text-align: center; display: flex; margin: auto">RENT.it</h1>
</header>

<body>
  <?php
  if (!isset($_SESSION)) {
    session_start();
  }
  ?>
  <form class="signup" action="" style="border: 1px solid #ccc">
    <div class="container">
      <h1 style="display: flex;  color: black">
        CREATE AN ACCOUNT
      </h1>
      <p>Please fill in this form to create an account.</p>

      <div class="form-element">
        <label for="email"><b>SURNAME</b></label>
        <input type="text" placeholder="Enter Surname" name="email" required />
      </div>

      <div class="form-element">
        <label for="email"><b>FORENAME</b></label>
        <input type="text" placeholder="Enter Forename" name="email" required />
      </div>

      <div class="form-element">
        <label for="email"><b>DATE OF BIRTH</b></label>
        <input type="text" placeholder="Enter Date of Birth" name="email" required />
      </div>

      <div class="form-element">
        <label for="email"><b>HOME ADDRESS</ADDress></b></label>
        <input type="text" placeholder="Enter Home Address" name="email" required />
      </div>

      <div class="form-element">
        <label for="email"><b>CONTACT NUMBER</b></label>
        <input type="text" placeholder="Enter Contact Number " name="email" required />
      </div>

      <div class="form-element">
        <label for="email"><b>EMAIL</b></label>
        <input type="text" placeholder="Enter Email" name="email" required />
      </div>

      <div class="form-element">
        <label for="psw"><b>PASSWORD</b></label>
        <input type="password" placeholder="Enter Password" name="psw" required />
      </div>

      <div class="form-element">
        <label for="psw-repeat"><b>REPEAT PASSWORD</b></label>
        <input type="password" placeholder="Repeat Password" name="psw-repeat" required />
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
  </form>
</body>

<script>
  // When the user clicks anywhere outside of the modal, close it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    }
  };
</script>

</html>
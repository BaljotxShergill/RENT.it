function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}

function logout() {
  location.replace("logout.php");
}

function signup() {
  location.replace("SIGN UP.php");
}

function home() {
  location.replace("index.php");
}

function clickimg(smallImg) {
  var fullImg = document.getElementById("imagebox");
  fullImg.src = smallImg.src;
}

function check() {
  if (
    document.getElementById("user_password").value ==
    document.getElementById("user_password1").value
  ) {
    document.getElementById("message").style.color = "green";
    document.getElementById("message").innerHTML = "matching";
  } else {
    document.getElementById("message").style.color = "red";
    document.getElementById("message").innerHTML = "not matching";
  }
}

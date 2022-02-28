
function openForm() {
    document.getElementById("myForm").style.display = "block";
}

function closeForm() {
    document.getElementById("myForm").style.display = "none";
}

function logout() {
  location.replace("logout.php");
}

function signup(){
    location.replace("SIGN UP.php");
}

function home(){
    location.replace("index.php");
}

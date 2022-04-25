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

function calculateAmount(val) {
  var tot_price = cost_per_day * val;
  /*display the result*/
  var divobj = document.getElementById('cost');
  divobj.value = tot_price;
}

function calculateDate(collection_date, days) {
  return_date = collection_date.setDate(collection_date.getDate() + parseInt(days)); //number  of days to add, e.x. 15 days
  return_time = new Date(return_date).toLocaleTimeString()
  return_date = new Date(return_date).toISOString().split('T')[0];
  /*display the result*/
  divobj = document.getElementById('returnDate');
  divobj.innerHTML = `${return_date} ${return_time}`;
}

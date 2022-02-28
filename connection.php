<?php
// Connect to server/database
$mysqli = mysqli_connect("localhost", "2038383", "3411", "db2038383");
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
// Run SQL query
$res = mysqli_query($mysqli, "SELECT * FROM email_password");
// Are there any errors in my SQL statement?
if (!$res) {
    print("MySQL error: " . mysqli_error($mysqli));
    exit;
}
// How many rows were returned?
echo ("<p>" . mysqli_num_rows($res) . " record(s) were returned...</p>");

// Loop through resultset and display each field's value
while ($row = mysqli_fetch_assoc($res)) {
    echo $row['email'] . " - " . $row['password'] . "<br>";
}

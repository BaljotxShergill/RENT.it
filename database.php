<?php
$servername = "localhost";
$username = "2038383";
$password = "3411";
$database_name = "db2038383";


// Create connection
$mysqli = mysqli_connect($servername, $username, $password, $database_name);
// Check connection
if ($mysqli->connect_error) {
    echo ("<script>window.alert('DATABASE NOT CONNECTED');</script>");
    die("Connection failed: " . $mysqli->connect_error);
}

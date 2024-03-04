<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "database";

$con = new mysqli($servername, $username, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

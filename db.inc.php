<?php
$hostname = "209.106.201.103";
$username = "dbstudent24"; //Your database username
$password = "greatdugong72"; //Your database password
$dbname = "dbstudent24"; //Your database

$conn = new mysqli($hostname, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

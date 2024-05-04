<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pokedex";

$connection = new mysqli($servername, $username, $password, $dbname);
if ($connection->connect_error) {
    die("Connection error: " . $connection->connect_error);
}
?>
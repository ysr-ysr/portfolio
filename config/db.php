<?php

$host = "localhost";
$db_name = "portfolio_contact";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $db_name);
if ($conn->connect_error) {
    die("Erreur connexion : " . $conn->connect_error);
}
?>
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$hostname = "localhost";
$username = "user"; #change username
$password = "pass"; #change password
$database = "BDD_DB"; #change database
$connection = mysqli_connect ($hostname, $username, $password, $database);
if (mysqli_connect_errno())
{
  echo "Erro: " . mysqli_connect_error();
}
?>

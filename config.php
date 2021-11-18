<?php

// $servername = "localhost";
// $database 	= "dbiantec_sumber_rejeki";
// $username 	= "dbiantec";
// $password 	= "8i8w6pAH0*:PnW";

$servername = "localhost";
$database 	= "db_sumber_rejeki";
$username 	= "root";
$password 	= "";

$connect 	= new mysqli($servername, $username, $password, $database);

if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}

?>
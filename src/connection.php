<?php

$db_host = "localhost";
$db_username = "root";
$db_password = "";
$db_name = "jezyki_obce";

$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);


if (!$conn) {
    die("Błąd połączenia z bazą danych: " . mysqli_connect_error());
}

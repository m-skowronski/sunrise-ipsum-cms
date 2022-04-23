<?php

$db_server = "localhost";
$db_user = "root";
$db_pwd = "";
$db_name = "cms";

$conn = mysqli_connect($db_server, $db_user, $db_pwd, $db_name);

if(!$conn) {
    die("Connection failed: ".mysqli_connect_error());
}

mysqli_set_charset($conn, "utf8");
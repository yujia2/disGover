<?php
DEFINE('DB_USER', 'cliu81_ad');
DEFINE('DB_PASSWORD', '12345');
DEFINE('DB_HOST', 'localhost');
DEFINE('DB_NAME', 'cliu81_main');

$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect to MySQL' .
    mysqli_connect_error());
?>
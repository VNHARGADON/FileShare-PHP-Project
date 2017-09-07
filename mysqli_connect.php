<?php

DEFINE('DB_Username', 'root');
DEFINE('DB_Password', '');
DEFINE('DB_Host', 'localhost');
DEFINE('DB_Name', 'fileshare');
$dbc = mysqli_connect(DB_Host, DB_Username, DB_Password, DB_Name) OR die('Could not connect to MySQL:');

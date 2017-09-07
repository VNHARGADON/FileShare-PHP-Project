<?php
require('mysqli_connect.php');
session_start();
$commentid = $_GET['commentid'];
$fileID = $_GET['FileID'];
$var = mysqli_query($dbc, "DELETE FROM comments WHERE commentid = '$commentid'");
ob_start();
header('Location:viewPost.php?FileID='.$fileID);

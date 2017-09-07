<?php
session_start();
session_destroy();
if (isset($_SESSION['user_session'])) {
    unset($_SESSION['user_session']);
    header("Location:index.php");
}else{
    echo 'You have accessed this page in error, press <a href="index.php">here</a> to return to the home page.';
}

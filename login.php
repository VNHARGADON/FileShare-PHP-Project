<?php
session_start();
require 'mysqli_connect.php';

if (isset($_POST['Submit'])) {

    $username = mysqli_real_escape_string($dbc, $_POST['username']);
    $password = mysqli_real_escape_string($dbc, $_POST['password']);
    $q = "SELECT * FROM users WHERE username= '$username' LIMIT 1";
    $res = mysqli_query($dbc, $q);
    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $_SESSION["user_session"] = $username;
        ob_start();
        header("Location:index.php");
    } else {
        $err = 1;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway|Muli" rel="stylesheet"> 
        <link rel="stylesheet" href="style.css">
        <title>Login</title>
    </head>
    <body>
        <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a></nav>
        <h2 class="header1">Login</h2><hr id="hr1">
        <p id="signupMess">Don't have an account? <a href="signUp.php">Sign up!</a></p>
        <form id="loginForm" method="post">
            <label>Username:</label><input placeholder="Username" name="username" id="username" required type="text"><br>
            <label>Password:</label><input placeholder="Password" min="8" name="password"required id="password" type="password"><br>
            <input type="submit"  name="Submit" value="Login" id="submit" />
        </form>
        <?php
        if (isset($_POST['Submit'])) {
            if ($err == 1) {
                echo '<p class="loginErr">Username and/or password are incorrect!</p>';
            }
        }
        ?>

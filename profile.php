<?php
require('mysqli_connect.php');
session_start();
if (isset($_SESSION["user_session"])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway|Muli" rel="stylesheet"> 
            <link rel="stylesheet" href="style.css">
            <title>Browse</title>
        </head>
        <body>
            <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a><?php
                if (isset($_SESSION["user_session"])) {
                    echo '<a href="logout.php" id="loginButton">Logout</a>';
                }
                ?> </nav>
            <h2 id="postsT">Your Posts</h2>
            <div id="hr1"><hr></div>
            <?php
            $username = mysqli_real_escape_string($dbc, $_SESSION['user_session']);
            $q = ("SELECT FileID, title, username FROM file WHERE username = '$username' ORDER BY FileID DESC ");
            $result = mysqli_query($dbc, $q);
            if (mysqli_num_rows($result) > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div id="profileCont"><p class="postV"><a href="viewPost.php?FileID=' . $row['FileID'] . '">' . $row['title'] . '</a></p></div>';
                }
            } else {
                echo '<p id="signupMess">You have no posts! Click <a href="submit.php">here</a> to make some!</p>';
            }
            ?>
        <?php } else {
            ?>
        <html>
            <head>
                <meta charset="UTF-8">
                <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway|Muli" rel="stylesheet"> 
                <link rel="stylesheet" href="style.css">
                <title>Browse</title>
            </head>
            <body>
                <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a><?php
                    if (!isset($_SESSION["user_session"])) {
                        echo '<a href="login.php" id="loginButton">Login</a><a href="signUp.php" id="signUpbutton">Sign Up</a>';
                    }
                    ?> </nav>
                <?php
                echo '<p class="loginErr">Please login to view this page.</p>';
            }
            ?>
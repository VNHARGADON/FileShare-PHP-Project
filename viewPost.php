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
            <title>View Post</title>
        </head>
        <body>
            <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a><?php
                if (isset($_SESSION["user_session"])) {
                    echo '<a href="logout.php" id="loginButton">Logout</a>';
                }
                ?></nav>
            <?php
            if (isset($_GET['FileID'])) {
                $fileID = $_GET['FileID'];
                $var = mysqli_query($dbc, "SELECT FileID, title,type,file FROM file WHERE FileID = $fileID");
                while ($row = mysqli_fetch_array($var)) {
                    echo '<div class="postContain">';
                    echo '<h2 class="postTitle">' . $row['title'] . '</h2>';
                    if ($row['type'] == 'image/jpg' || $row['type'] == 'image/png' || $row['type'] == 'image/jpeg' || $row['type'] == 'image/gif') {
                        //is image
                        echo '<img src="uploads/' . $row['file'] . '" class="image"/></div><br/>';
                        echo '<hr id="hr1">';
                    } else {
                        //is text
                        $f = array(file_get_contents("uploads/" . $row['file']));
                        $fileCont = implode(PHP_EOL, $f);
                        $cont = mb_convert_encoding($fileCont, 'UTF-8', 'ISO-8859-1');
                        echo '<hp class="postContent">' . (nl2br($cont)) . '</p></div><br/>';
                        echo '<hr id="hr1">';
                    }
                }
            }
            include ("comments.php");
            ?>
            <?php
        } else {
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
            if (isset($_GET['FileID'])) {
                $fileID = $_GET['FileID'];
                $var = mysqli_query($dbc, "SELECT FileID, title,type,file FROM file WHERE FileID = $fileID");
                while ($row = mysqli_fetch_array($var)) {
                    echo '<div class="postContain">';
                    echo '<h2 class="postTitle">' . $row['title'] . '</h2>';
                    if ($row['type'] == 'image/jpg' || $row['type'] == 'image/png' || $row['type'] == 'image/jpeg' || $row['type'] == 'image/gif') {
                        //is image
                        echo '<img src="uploads/' . $row['file'] . '" class="image"/></div><br/>';
                        echo '<hr id="hr1">';
                    } else {
                        //is text
                        $f = array(file_get_contents("uploads/" . $row['file']));
                        $fileCont = implode(PHP_EOL, $f);
                        $cont = mb_convert_encoding($fileCont, 'UTF-8', 'ISO-8859-1');
                        echo '<hp class="postContent">' . (nl2br($cont)) . '</p></div><br/>';
                        echo '<hr id="hr1">';
                    }
                }
            }
            include ("comments.php");
            ?>
                <?php
            }
            ?>

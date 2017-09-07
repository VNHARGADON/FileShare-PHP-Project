<?php
require('mysqli_connect.php');
session_start();
if (isset($_SESSION["user_session"])) {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway" rel="stylesheet"> 
            <link rel="stylesheet" href="style.css">
            <title>Submit</title>
        </head>

        <body>
            <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a></nav>
            <div id="subForm">
                <p id="signupMess">Accepted File types: .txt, .gif, .jpeg/jpg, .png</p>
                <form id="submitForm" method="post" enctype="multipart/form-data">
                    <label>Title: </label><input name="title" required type="text" placeholder="Title"><br><br>
                    <label>File: </label> <input type="file" required name="file"><br><br>
                    <input type="hidden" name="id"/>
                    <input type="submit" name="Submit" value="Submit" />
                </form></div>
        </body>
    </html>
    <?php
    if (isset($_POST['Submit'])) {
        if (isset($_POST['title'])) {
            if (is_string($_POST['title'])) {
                $titleV = $_POST['title'];
                $file = rand(1000, 100000) . "-" . $_FILES['file']['name'];
                $file_loc = $_FILES['file']['tmp_name'];
                $file_size = $_FILES['file']['size'];
                $file_type = $_FILES['file']['type'];
                $fileT = pathinfo($file);
                $fileT['extension'];
                $acceptedEx = Array('jpg', 'png', 'jpeg', 'txt');
                $folder = "uploads/";
                $new_size = $file_size / 1024;
                $username = $_SESSION["user_session"];
                $file_type = mysqli_real_escape_string($dbc, $file_type);
                $new_size = mysqli_real_escape_string($dbc, $new_size);
                $username = mysqli_real_escape_string($dbc, $username);
                $new_file_name = strtolower($file);
                $final_file = str_replace(' ', '-', $new_file_name);
                if (in_array($fileT['extension'], $acceptedEx)) {
                    if ($new_size > 500000) {
                        if (move_uploaded_file($file_loc, $folder . $final_file)) {
                            if ($file_type == 'image/jpeg' || $file_type == 'image/gif' || $file_type == 'image/png' || $file_type == 'image/jpeg' || $file_type == 'text/plain') {
                                //is image
                                $q = mysqli_query($dbc, "INSERT INTO file (Title,username,type,size,file) VALUES ('$titleV','$username','$file_type','$new_size','$final_file')") OR die(mysqli_error_list($dbc));
                                ob_start();
                                header("Location: index.php");
                            } else {
                                echo '<p id="signupMess">File type not accepted!</p>';
                            }
                        }
                    } else {
                        echo '<p id="signupMess">File size too large</p>';
                    }
                } else {
                    echo '<p id="signupMess">File type not accepted!</p>';
                }
            }
        }
    }
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
            <p class="loginErr">Please login to submit your files!</p>
            <?php
        }
        ?> 

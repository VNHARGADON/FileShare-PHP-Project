<?php
require('mysqli_connect.php');
?>
<?php
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
            <h2 id="postsT">Recent Posts</h2>
            <div id="hr1"><hr></div>
                
            <?php
            $var = $dbc->query('SELECT FileID, title,username FROM file ORDER BY FileID DESC');
            while ($row = $var->fetch_assoc()) {
                echo '<div id="cont"><p class="postV"><a href="viewPost.php?FileID=' . $row['FileID'] . '">' . $row['title'] . '</a> : ' . $row['username'] . '</p></div>';
            }
            ?>
        </body>
    </html>
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
            <h2 id="postsT">Recent Posts</h2>
            <div id="hr1"><hr></div>

            <?php
            $var = $dbc->query('SELECT FileID, title,username FROM file ORDER BY FileID DESC');
            while ($row = $var->fetch_assoc()) {
                echo '<div id="cont"><p class="postV"><a href="viewPost.php?FileID=' . $row['FileID'] . '">' . $row['title'] . '</a> : ' . $row['username'] . '</p></div>';
            }
            ?>
        </body>
    </html>
    <?php
}
?>
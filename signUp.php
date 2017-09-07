<html>
    <head>
        <meta charset="UTF-8">
        <link href="https://fonts.googleapis.com/css?family=Montserrat|Raleway|Muli" rel="stylesheet"> 
        <link rel="stylesheet" href="style.css">
        <title>Sign Up</title>
    </head>
    <body>
        <nav id="navbar"><img src="" id="logo"><a href="index.php" class="button">Browse</a>  <a href="submit.php" class="button">Submit</a>  <a href="profile.php" class="button">Profile</a></nav>
        <h2 class="header1">Sign Up</h2><hr id="hr1">
        <p id="signupMess">Already have an account? <a href="login.php">Login!</a></p>
        <form id="signUpForm" method="post">
            <label>Username:</label><input placeholder="Username" name="username" required type="text"><br>
            <label>Password:</label><input placeholder="Password" min="8" name="password"required oninvalid="Password must be alphanumeric and be a minimum of 8 characters long" type="password"><br>  
            <input type="submit" name="Submit" value="Sign Up" /></form>
        <?php
        require('mysqli_connect.php');
        if (isset($_POST['Submit'])) {
            $password = $_POST['password'];
            if ((isset($_POST["username"]) && (isset($_POST["password"])))) {
                $uppercase = preg_match('@[A-Z]@', $password);
                $lowercase = preg_match('@[a-z]@', $password);
                $number = preg_match('@[0-9]@', $password);
                if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
                    echo '<p id="signupMess">Password must be alphanumeric and be a minimum of 8 characters long</p>';
                } else {
                    $username = $_POST['username'];
                    $q = "SELECT * FROM users WHERE username= '$username' LIMIT 1";
                    $res = mysqli_query($dbc, $q);
                    $row = mysqli_fetch_array($res, MYSQLI_ASSOC);
                    $count = mysqli_num_rows($res);
                    if ($count == 0) {
                        if ((is_string($username) == true)) {
                            $q = mysqli_query($dbc, "INSERT INTO users(username,password) VALUES ('$username','$password')");
                            ob_start();
                            header("Location:login.php");
                        }
                    } else {
                        echo '<p id="signupMess">Username taken!</p>';
                    }
                }
            }
        }
        ?>
    </body>
</html>

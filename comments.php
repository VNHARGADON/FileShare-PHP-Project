<?php
if (isset($_SESSION["user_session"])) {
    ?>
    <div align="center">
        <br><br><br><br>
        <form method="post">
            <input placeholder="Write a comment!" class="com" name="comment" type="text"/>
            <input type="submit" name="Submit" class="butt" value="Submit" />
        </form></div>
    <?php
    //submit comments
    if (isset($_GET['FileID'])) {
        if (isset($_POST['Submit'])) {
            if (isset($_POST['comment'])) {
                $fileid = $_GET['FileID'];
                $username = mysqli_real_escape_string($dbc, $_SESSION["user_session"]);
                $comment = mysqli_real_escape_string($dbc, $_POST['comment']);
                $var = mysqli_query($dbc, "INSERT INTO comments (fileID,message,username) VALUES('$fileid','$comment','$username')");
            }
        }//view comments
        $fileID = $_GET['FileID'];
        $var = mysqli_query($dbc, "SELECT commentid, FileID, message, username FROM comments WHERE FileID = $fileID ORDER BY commentid DESC");
        while ($row = mysqli_fetch_array($var)) {
            $commentid = $row['commentid'];
            echo '<div class="commentCont">';
            if ($row['username'] == $_SESSION['user_session']) {
                echo '<a id="delButton" title="Delete Comment" href="deleteComment.php?FileID='.$fileID.'&commentid='.$row['commentid'] .'">X</a>';
            }
            echo '<h4 class="commentUser">' . $row['username'] . '</h4>';
            echo '<hp class="message">' . ($row['message']) . '</p>';
            echo '</div><br/>';
        }
    }
    ?>
    <?php
} else {
    ?>
    <p id="signupMess">Please sign in to leave a comment!</p><?php
    $fileID = $_GET['FileID'];
        $var = mysqli_query($dbc, "SELECT commentid, FileID, message, username FROM comments WHERE FileID = $fileID ORDER BY commentid DESC");
        while ($row = mysqli_fetch_array($var)) {
            $commentid = $row['commentid'];
            echo '<div class="commentCont">';
            echo '<h4 class="commentUser">' . $row['username'] . '</h4>';
            echo '<hp class="message">' . ($row['message']) . '</p>';
            echo '</div><br/>';
        }
    ?>
<?php }
?>
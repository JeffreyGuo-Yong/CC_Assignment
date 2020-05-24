<?php
session_start();
$registerMessage = $_GET['registerMessage'];
if($registerMessage != null){
    echo "<script>alert('" . $registerMessage . "')</script>";
}
$postMessage = $_GET['postMessage'];
if($postMessage != null){
    echo "<script>alert('" . $postMessage . "')</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body class="indexBody" onload="changeSize()">

<div class="indexMain">
    <div class="header">
        <div class="logo">
            <img src="style/logo.png">
        </div>
        <div class="title">
            <p>Pet & Family-Instance ID: i-0ae50324c23a940fb</p>
        </div>
        <?php
            $user = $_SESSION['user'];
            if($user == null){
                echo "<div class='buttonDiv'>";
                echo "<button class='button' type='button' onclick='login()'>";
                echo "<img src='style/button.png'>";
                echo "<p>Login</p>";
                echo "</button>";
                echo "</div>";

                echo "<div class='register'>";
                echo "<a href='register.php'>Register here</a>";
                echo "</div>";
            }
        ?>
    </div>

    <div class="search">
        <div class="searchForm">
            <form action="postList.php" method="post" target="indexIframe">
                <div class="radioDiv">
                    <div class="inputDiv">
                        <input type="radio" name="petType" value="dog">
                    </div>
                    <p>Dog</p>
                </div>
                <div class="radioDiv">
                    <div class="inputDiv">
                        <input type="radio" name="petType" value="cat">
                    </div>
                    <p>Cat</p>
                </div>
                <div class="radioDiv">
                    <div class="inputDiv">
                        <input type="radio" name="petType" value="all">
                    </div>
                    <p>All</p>
                </div>
                <div class="buttonDiv">
                    <button class="button" type="submit">
                        <img src="style/search.png">
                        <p>Search</p>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <?php
        $user = $_SESSION['user'];
        if($user != null){
            echo "<div class='left' id='left'>";

            echo "<div class='welcome'>";
            echo "<p>~Welcome~</p>";
            echo "<p>" . $user['nickname'] . "</p>";
            echo "</div>";

            echo "<div class='buttonDiv'>";
            echo "<button class='button' type='button' onclick='post()'>";
            echo "<img src='style/postButton.png'>";
            echo "<p>Post</p>";
            echo "</button>";
            echo "</div>";

            echo "<div class='buttonDiv'>";
            echo "<button class='button' type='button' onclick='logout()'>";
            echo "<img src='style/button.png'>";
            echo "<p>Logout</p>";
            echo "</button>";
            echo "</div>";

            echo "</div>";
        }
    ?>

    <div class="right" id="right">
        <iframe id="iframe" name="indexIframe" frameborder="0" src="postList.php"></iframe>
    </div>

</div>

</body>
</html>
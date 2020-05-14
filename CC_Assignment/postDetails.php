<?php
    require "functions.php";
    $uni_post_id = $_GET['postID'];
    $post = getPostDetails($uni_post_id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post Details</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/showMap.js"></script>
</head>
<body>
<div class="postDetailsMain">
    <div class="content">

        <div class="postTitle">
            <img src="style/registerLogo.png">
            <div>Post Details</div>
        </div>

        <div class="postInfo">
            <div class="step">
                <p>01: Post Information</p>
            </div>
            <div class="info">
                <h3><?php echo $post[0]['title']['S'] ?></h3>
            </div>
            <div class="info">
                <p>Type: <?php echo $post[0]['type']['S'] ?> Date: <?php echo $post[0]['post_date']['S'] ?></p>
            </div>
            <div class="info">
                <p>Content: <?php echo $post[0]['content']['S'] ?></p>
            </div>
            <div class="step">
                <p>02: Pet Image</p>
            </div>
            <div class="image">
                <?php
                    $url = getImageURL($uni_post_id);
                    echo "<img src='$url'>";
                ?>
            </div>
            <div class="step">
                <p>03: Address Information</p>
            </div>
            <div class="address">
                <h3><?php echo $post[0]['address']['S'] ?></h3>
                <?php
                    echo "<input type='text' id='latitude' hidden='hidden' value='" . $post[0]['latitude']['N'] . "'>";
                    echo "<input type='text' id='longitude' hidden='hidden' value='" . $post[0]['longitude']['N'] . "'>";
                ?>
            </div>
            <div class="map" id="map"></div>
            <div class="buttonDiv">
                <button class="button" type="button" onclick="window.location.href='postList.php'">
                    <img src="style/button.png">
                    <p>Back</p>
                </button>
                <button class="button" type="button">
                    <img src="style/replyButton.png">
                    <p>Reply</p>
                </button>
            </div>
        </div>

    </div>
</div>
</body>
</html>
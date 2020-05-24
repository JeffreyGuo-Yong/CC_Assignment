<?php
    require "functions.php";
    $uni_post_id = $_GET['postID'];
    $postParameter = [
            'id' => $uni_post_id
    ];
    $post = getQueryResult("post", $postParameter);

    $uni_user_id = $post[0]['uni_user_id'];
    $userParameter = [
            'id' => $uni_user_id
    ];
    $user = getQueryResult("user", $userParameter);
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
                <h3><?php echo $post[0]['title'] ?></h3>
            </div>
            <div class="info">
                <p>Type: <?php echo $post[0]['type'] ?> Date: <?php echo $post[0]['post_date'] ?></p>
            </div>
            <div class="info">
                <p>Content: <?php echo $post[0]['content'] ?></p>
            </div>
            <div class="step">
                <p>02: Contact Information</p>
            </div>
            <div class="info">
                <p>Poster Name: <?php echo $user['name'] ?></p>
            </div>
            <div class="info">
                <p>Email Address: <?php echo $user['email'] ?></p>
            </div>
            <div class="info">
                <p>Phone Number: <?php echo $user['phone'] ?></p>
            </div>
            <div class="step">
                <p>03: Pet Image</p>
            </div>
            <div class="image">
                <?php
                    $url = getImageURL($uni_post_id);
                    echo "<img src='$url'>";
                ?>
            </div>
            <div class="step">
                <p>04: Address Information</p>
            </div>
            <div class="address">
                <h3><?php echo $post[0]['address'] ?></h3>
                <?php
                    echo "<input type='text' id='latitude' hidden='hidden' value='" . $post[0]['latitude'] . "'>";
                    echo "<input type='text' id='longitude' hidden='hidden' value='" . $post[0]['longitude'] . "'>";
                ?>
            </div>
            <div class="map" id="map"></div>
            <div class="buttonDiv">
                <button class="button" type="button" onclick="window.location.href='postList.php'">
                    <img src="style/button.png">
                    <p>Back</p>
                </button>
            </div>
        </div>

    </div>
</div>
</body>
</html>
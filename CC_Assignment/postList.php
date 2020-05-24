<?php
    require "functions.php";

    $isPetType = isset($_POST['petType']);
    if($isPetType == 1){
        $petType = $_POST['petType'];
        $parameter = [
            'type' => $petType
        ];
        if($petType != "all"){
            $posts = getQueryResult("postType", $parameter);
        }else{
            $posts = getScanResult("post");
        }
    }else{
        $posts = getScanResult("post");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Post List</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body>

<div class="postListMain">
    <?php
        if($posts == null){

        }else{
            foreach ($posts as $post){
                echo "<div class='post'>";
                echo "<table>";

                echo "<tr>";
                echo "<th colspan='3'>" . $post['title'] . "</th>";
                echo "</tr>";

                echo "<tr>";
                echo "<td>Type: " . $post['type'] . "</td>";
                echo "<td>Date: " . $post['post_date'] . "</td>";
                echo "<td rowspan='2' class='buttonTD'>";
                echo "<button class='button' type='button' onclick='getDetails(" . "\"" . $post['uni_post_id'] . "\"" . ")'>";
                echo "<img src='style/button.png'>";
                echo "<p>Details</p>";
                echo "</button>";
                echo "</td>";
                echo "</tr>";

                echo "<tr>";
                echo "<td colspan='2'>Content: " . $post['content'] . "</td>";
                echo "</tr>";

                echo "</table>";
                echo "<div>";
            }
        }
    ?>
</div>

</body>
</html>
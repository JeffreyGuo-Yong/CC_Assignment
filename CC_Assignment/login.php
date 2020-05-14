<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
</head>
<body class="registerBody">

<div class="loginMain">
    <div class="content">
        <div class="loginTitle">
            <img src="style/registerLogo.png">
            <div>Login</div>
        </div>

        <div class="form">
            <form action="loginController.php" method="post">
                <div class="input">
                    <input type="text" placeholder="Email or Phone Number" name="username">
                </div>
                <div class="input">
                    <input type="password" placeholder="Password" name="password">
                </div>
                <div class="buttonDiv">
                    <button class="button" type="button" onclick="window.location.href='index.php'">
                        <img src="style/button.png">
                        <p>Back</p>
                    </button>
                    <button class="button" type="submit">
                        <img src="style/button.png">
                        <p>Register</p>
                    </button>
                </div>
                <div class="message">
                    <?php echo $_GET['message'] ?>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="style/style.css">
    <script type="text/javascript" src="script/script.js"></script>
</head>
<body class="registerBody" onload="setRegisterCookieValue()">

<div class="registerMain">
    <div class="content">
        <div class="title">
            <img src="style/registerLogo.png">
            <div>Register Account</div>
        </div>

        <div class="form">
            <form action="registerController.php" method="post" onsubmit="return verifyRegisterForm()">
                <div class="input">
                    <input type="text" placeholder="Nickname" name="nickname" id="nickname" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Name" name="name" id="name" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Email Address" name="email" id="email" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Phone Number" name="phone" id="phone" onchange="recordRegisterForm(this)">
                </div>
                <div class="check">
                    <input type="text" placeholder="Verification code" id="inputCode" onchange="checkVerifyCode()">
                    <?php
                        session_start();
                        if(isset($_SESSION['phoneVerifyCode'])){
                            $verifyCode = $_SESSION['phoneVerifyCode'];
                        }else{
                            $verifyCode = 0;
                        }
                        echo "<input type='text' id='phoneVerifyCode' hidden='hidden' value='" . $verifyCode . "'>";
                    ?>
                    <div class="button">
                        <button type="button" onclick="verifyPhone()">Verify Phone</button>
                    </div>
                </div>
                <div class="message" id="verifyCodeMessage">
                    <?php echo $_GET['verifyPhone']; ?>
                </div>
                <div class="input">
                    <input type="password" placeholder="Password" name="password" id="password">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Room Number" name="room" id="room" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Street" name="street" id="street" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="City" name="city" id="city" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="select">
                    <select name="state" id="state">
                        <option value="" selected="selected">Please select state</option>
                        <option value="ACT">Australian Capital Territory</option>
                        <option value="NSW">New South Wales</option>
                        <option value="NT ">Northern Territory</option>
                        <option value="QLD">Queensland</option>
                        <option value="SA ">South Australia</option>
                        <option value="TAS">Tasmania</option>
                        <option value="VIC">Victoria</option>
                        <option value="WA ">Western Australia</option>
                    </select>
                </div>
                <div class="message">
                </div>
                <div class="input">
                    <input type="text" placeholder="Postcode" name="postcode" id="postcode" onchange="recordRegisterForm(this)">
                </div>
                <div class="message">
                </div>
                <div class="select">
                    <select name="notificationType" id="notificationType">
                        <option value="" selected="selected">Please select notification type</option>
                        <option value="email">Email notification</option>
                        <option value="phone">Phone notification</option>
                    </select>
                </div>
                <div class="message">
                </div>
                <div class="buttonDiv">
                    <button class="button" type="button" onclick="registerPageBack()">
                        <img src="style/button.png">
                        <p>Back</p>
                    </button>
                    <button class="button" type="submit">
                        <img src="style/button.png">
                        <p>Register</p>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
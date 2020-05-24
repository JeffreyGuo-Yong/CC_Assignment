function login(){
    window.location.href = "login.php";
}
function logout() {
    window.location.href = 'logoutController.php';
}
function post(){
    window.location.href = 'post.html';
}
function verifyPhone(){
    var phoneNumber = document.getElementById('phone').value;
    if(phoneNumber == "" || phoneNumber == null){
        alert("Please enter phone number.")
    }else{
        window.location.href = 'verifyPhoneController.php?phone=' + phoneNumber.trim();
    }
}

// recode form to cookie
function recordRegisterForm(input){
    var id = input.id;

    if(id == "nickname"){
        document.cookie = "nickname=" + input.value;
    }else if(id == "name"){
        document.cookie = "name=" + input.value;
    }else if(id == "email"){
        document.cookie = "email=" + input.value;
    }else if(id == "phone"){
        document.cookie = "phone=" + input.value;
    }else if(id == "room"){
        document.cookie = "room=" + input.value;
    }else if(id == "street"){
        document.cookie = "street=" + input.value;
    }else if(id == "city"){
        document.cookie = "city=" + input.value;
    }else if(id == "postcode"){
        document.cookie = "postcode=" + input.value;
    }
}

// read from cookie and set value to input
function setRegisterCookieValue(){
    var nickname = document.getElementById("nickname");
    var name = document.getElementById("name");
    var email = document.getElementById("email");
    var phone = document.getElementById("phone");
    var room = document.getElementById("room");
    var street = document.getElementById("street");
    var city = document.getElementById("city");
    var postcode = document.getElementById("postcode");

    var cookies = document.cookie.split(";");
    for(var i = 0; i<cookies.length; i++){
        var cookie = cookies[i].trim().split("=");
        if(cookie[0] == "nickname"){
            nickname.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "name"){
            name.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "email"){
            email.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "phone"){
            phone.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "room"){
            room.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "street"){
            street.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "city"){
            city.setAttribute("value", cookie[1]);
        }else if(cookie[0] == "postcode"){
            postcode.setAttribute("value", cookie[1]);
        }
    }
}

function removeRegisterCookie(){
    document.cookie = "nickname=;";
    document.cookie = "name=;";
    document.cookie = "email=;";
    document.cookie = "phone=;";
    document.cookie = "room=;";
    document.cookie = "street=;";
    document.cookie = "city=;";
    document.cookie = "postcode=;";
}

function registerPageBack(){
    removeRegisterCookie();
    window.location.href="index.php";
}

// change 'right' part size
function changeSize(){
    removeRegisterCookie();
    var left = document.getElementById('left');
    var right = document.getElementById('right');
    if(left != null){
        right.style.width = "85%";
        right.style.left = "15%";
    }else{
        right.style.width = "100%";
        right.style.left = "0%";
    }
}

function getDetails(id){
    window.location.href = "postDetails.php?postID=" + id;
}
/*
    check file type
    get file name
 */
function printFileName(){
    var file = document.getElementById("file").files[0];
    if(file.value == "" || file == null){
        alert("Please select a file");
    }else{
        var suffixIndex = file.name.lastIndexOf(".");
        var lastname = file.name.substring(suffixIndex, file.name.length);
        if(!/.(gif|jpg|jpeg|png)$/.test(lastname.toLowerCase())){
            alert("Please select a picture");
            return;
        }else{
            document.getElementById("fileLabel").innerHTML = file.name;
        }
    }
}

// verify register form
function verifyRegisterForm(){
    var nickname = document.getElementById("nickname");
    var name = document.getElementById("name");
    var email = document.getElementById("email");
    var phone = document.getElementById("phone");
    var password = document.getElementById("password");
    var room = document.getElementById("room");
    var street = document.getElementById("street");
    var city = document.getElementById("city");
    var state = document.getElementById("state");
    var postcode = document.getElementById("postcode");
    var notificationType = document.getElementById("notificationType");

    if(nickname.value == "" || nickname.value == null){
        nickname.parentElement.nextElementSibling.innerHTML = "Please enter nickname";
        nickname.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        nickname.parentElement.nextElementSibling.innerHTML = "";
    }

    if(name.value == "" || name.value == null){
        name.parentElement.nextElementSibling.innerHTML = "Please enter name";
        name.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        name.parentElement.nextElementSibling.innerHTML = "";
    }

    if(email.value == "" || email.value == null){
        email.parentElement.nextElementSibling.innerHTML = "Please enter email address";
        email.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        email.parentElement.nextElementSibling.innerHTML = "";
    }

    if(phone.value == "" || phone.value == null){
        phone.parentElement.nextElementSibling.nextElementSibling.innerHTML = "Please enter phone number";
        phone.parentElement.nextElementSibling.nextElementSibling.style.color = "red";
        return false;
    }else{
        var verifyCode = document.getElementById('phoneVerifyCode');
        var inputCode = document.getElementById('inputCode');
        if(verifyCode.value != inputCode.value){
            phone.parentElement.nextElementSibling.nextElementSibling.innerHTML = "Verify code is wrong";
            phone.parentElement.nextElementSibling.nextElementSibling.style.color = "red";
            return false;
        }
        phone.parentElement.nextElementSibling.nextElementSibling.innerHTML = "";
    }

    if(password.value == "" || password.value == null){
        password.parentElement.nextElementSibling.innerHTML = "Please enter password";
        password.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        password.parentElement.nextElementSibling.innerHTML = "";
    }

    if(room.value == "" || room.value == null){
        room.parentElement.nextElementSibling.innerHTML = "Please enter room number";
        room.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        room.parentElement.nextElementSibling.innerHTML = "";
    }

    if(street.value == "" || street.value == null){
        street.parentElement.nextElementSibling.innerHTML = "Please enter street";
        street.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        street.parentElement.nextElementSibling.innerHTML = "";
    }

    if(city.value == "" || city.value == null){
        city.parentElement.nextElementSibling.innerHTML = "Please enter city";
        city.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        city.parentElement.nextElementSibling.innerHTML = "";
    }

    if(state.value == "" || state.value == null){
        state.parentElement.nextElementSibling.innerHTML = "Please select state";
        state.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        state.parentElement.nextElementSibling.innerHTML = "";
    }

    if(postcode.value == "" || postcode.value == null){
        postcode.parentElement.nextElementSibling.innerHTML = "Please enter postcode";
        postcode.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        postcode.parentElement.nextElementSibling.innerHTML = "";
    }

    if(notificationType.value == "" || notificationType.value == null){
        notificationType.parentElement.nextElementSibling.innerHTML = "Please select notification type";
        notificationType.parentElement.nextElementSibling.style.color = "red";
        return false;
    }else{
        notificationType.parentElement.nextElementSibling.innerHTML = "";
    }

    return true;
}

// check verify code
function checkVerifyCode(){
    var verifyCode = document.getElementById('phoneVerifyCode');
    var inputCode = document.getElementById('inputCode');
    var message = document.getElementById('verifyCodeMessage');

    if(verifyCode.value == 0){
        message.innerHTML = "Please click 'verify' button to get the verify code";
        message.style.color = "red";
    }else{
        if(verifyCode.value == inputCode.value){
            message.innerHTML = "Verify success"
            message.style.color = "green";
        }else{
            message.innerHTML = "Verify code is wrong";
            message.style.color = "red";
        }
    }
}

// verify post form
function verifyPostForm(){
    var title = document.getElementById("title");
    var type = document.getElementById('type');
    var content = document.getElementById('content');
    var file = document.getElementById('file');
    var inputAddress = document.getElementById('inputAddress');

    if(title.value == "" || title.value == null){
        title.parentElement.nextElementSibling.innerHTML = "Please enter post title";
        return false;
    }else{
        title.parentElement.nextElementSibling.innerHTML = "";
    }

    if(type.value == "" || type.value == null){
        type.parentElement.nextElementSibling.innerHTML = "Please enter post type";
        return false;
    }else{
        type.parentElement.nextElementSibling.innerHTML = "";
    }

    if(content.value == "" || content.value == null){
        content.parentElement.nextElementSibling.innerHTML = "Please enter post content";
        return false;
    }else{
        content.parentElement.nextElementSibling.innerHTML = "";
    }

    if(file.value == "" || file.value == null){
        file.parentElement.nextElementSibling.innerHTML = "Please select a image";
        return false;
    }else{
        file.parentElement.nextElementSibling.innerHTML = "";
    }

    if(inputAddress.value == "" || inputAddress.value == null){
        inputAddress.parentElement.nextElementSibling.innerHTML = "Please enter address";
        return false;
    }else{
        inputAddress.parentElement.nextElementSibling.innerHTML = "";
    }

    return true;
}
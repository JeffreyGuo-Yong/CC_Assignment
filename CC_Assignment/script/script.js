function login(){
    window.location.href = "login.php";
}
function logout() {
    window.location.href = 'logoutController.php';
}
function post(){
    window.location.href = 'post.html';
}

// change 'right' part size
function changeSize(){
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
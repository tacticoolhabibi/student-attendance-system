document.getElementById("loginForm").addEventListener("submit", function(e){

    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    if(username === "" || password === ""){
        e.preventDefault();
        alert("Please enter username and password");
    }

});
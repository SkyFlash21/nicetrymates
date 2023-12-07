var r = document.getElementById("register");
var l = document.getElementById("login");
var btn = document.getElementById("btn");

function register(){
    l.style.left = "-800px";
    r.style.left = "150px";
    btn.style.left = "50%";
}

function login(){
    l.style.left = "150px";
    r.style.left = "800px";
    btn.style.left = "0%";
}
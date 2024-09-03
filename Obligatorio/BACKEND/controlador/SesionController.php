<?php
$funcion = $_GET["funcion"];
switch ($funcion) {
    case "register":
        register();
        break;
    case "login":
        login();
        break;
    case "logOut":
        logOut();
        break;
}

function register() {
    $email = $_POST["email"];
    $password = $_POST["password"];
}


function login() {
    $email = $_POST["email"];
    $password = $_POST["password"];
    
  
  
}



function logOut() {

}
